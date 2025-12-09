document.addEventListener("DOMContentLoaded", () => {

  if  (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
  introBtnReducedMotion();
  fullPhraseEnd();
  return;
  } else {
    typingNormal();
  }
});// INTRO BUTTON 


function introBtnReducedMotion() {
  const introText = document.querySelector('.intro-text');
  const accueil = document.getElementById('accueil-content');
  const introBtn = document.querySelector('.intro-btn');
  const introBG = document.querySelector('.intro-gradient-bg') || document.getElementById('intro-bg') || document.querySelector('.intro-bg');
  if (!introText || !accueil) return;

  const primary = introText.querySelector('p') || document.createElement('p');
  if (!introText.contains(primary)) introText.appendChild(primary);


  // Show button so user can always skip
  if (introBtn) { introBtn.classList.add('show'); introBtn.setAttribute('aria-hidden', 'false'); }

  let stopped = false;
  function openCurtains() {
    if (stopped) return;
    stopped = true;
    document.body.classList.add('grid-visible');
    document.body.classList.remove('intro-running');
    if (introBG) introBG.classList.add('open');
    accueil.style.opacity = 1;
    if (introBtn) {
      introBtn.classList.remove('show');
      introBtn.setAttribute('aria-hidden', 'true');
      try { introBtn.setAttribute('disabled', 'true'); } catch (e) {}
      setTimeout(() => { introBtn.style.display = 'none'; }, 500);
    }
    console.log('[intro] dismissed');
  }

  // skip via button — add `hide` class so it can be visually hidden immediately
  if (introBtn) introBtn.addEventListener('click', () => { 
    console.log('[intro] button click'); try { introBtn.classList.add('hide'); } catch (e) {} openCurtains(); 
  }, { once: true });

  // keyboard skip
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ' || e.key === 'Escape') {
      console.log('[intro] keyboard dismiss', e.key);
      openCurtains();
    }
  });


  // fallback: if something blocks animation or the typing interval, ensure user can dismiss
  setTimeout(() => {
    if (!stopped) {
      console.warn('[intro] fallback: enabling forced dismiss');
      // ensure button still works
      if (introBtn) {
        try { introBtn.style.display = 'block'; introBtn.classList.add('show'); } catch (e) {}
      }
    }
  }, 4000);
}

//TYPING ANIMATION WITH DELETION AND MULTI-PHRASE CYCLE
function fullPhraseEnd() {
  const introText = document.querySelector('.intro-text');
  const introBtn = document.querySelector('.intro-btn');
  if (!introText) return;

  // phrases to cycle through
  const phrases = ["Bienvenue à", "l'ExpoTim", "2026"];
  // final assembled lines (map to .fp-line-1, .fp-line-2, .fp-line-3)
  const finalLines = ["Bienvenue à", "ExpoTim", "2026"];

  const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // create container for typing if not present
  let fullPhrase = introText.querySelector('.full-phrase');
  if (!fullPhrase) {
    fullPhrase = document.createElement('span');
    fullPhrase.className = 'full-phrase';
    // create lines
    finalLines.forEach((line, idx) => {
      const el = document.createElement('span');
      el.className = `fp-line fp-line-${idx+1}`;
      fullPhrase.appendChild(el);
    });
    introText.appendChild(fullPhrase);
  }

  // typing element (single-line visible while cycling)
  let typingEl = introText.querySelector('.typing-line');
  if (!typingEl) {
    typingEl = document.createElement('p');
    typingEl.className = 'typing-line';
    // create a holder for the typed text and a separate caret so we don't wipe the caret when
    // manipulating textContent
    const textHolder = document.createElement('span');
    textHolder.className = 'typing-text';
    const caret = document.createElement('span');
    caret.className = 'typing-caret';
    caret.setAttribute('aria-hidden', 'true');
    typingEl.appendChild(textHolder);
    typingEl.appendChild(caret);
    introText.insertBefore(typingEl, introText.firstChild);
  }

  // helper: sleep
  const wait = (ms) => new Promise(r => setTimeout(r, ms));

  // abort if intro dismissed (body.grid-visible)
  const aborted = () => document.body.classList.contains('grid-visible');

  async function typeText(holder, text, speed = 60) {
    holder.textContent = '';
    for (let i = 0; i < text.length; i++) {
      if (aborted()) return false;
      holder.textContent += text[i];
      await wait(speed + Math.floor(Math.random() * 40));
    }
    return true;
  }

  async function deleteText(holder, speed = 40) {
    while (holder.textContent.length > 0) {
      if (aborted()) return false;
      holder.textContent = holder.textContent.slice(0, -1);
      await wait(speed + Math.floor(Math.random() * 30));
    }
    return true;
  }

  // per-character reveal for final lines
  function revealFinal() {
    // populate fp lines with span.char wrappers
    const lines = fullPhrase.querySelectorAll('.fp-line');
    lines.forEach((lineEl, idx) => {
      const text = finalLines[idx] || '';
      lineEl.innerHTML = '';
      for (const ch of text) {
        const span = document.createElement('span');
        span.className = `char ${ch === ' ' ? 'space' : ''}`.trim();
        span.textContent = ch;
        lineEl.appendChild(span);
      }
    });

    // show container (CSS handles animation)
    requestAnimationFrame(() => fullPhrase.classList.add('show'));

    // stagger reveal per char
    const revealDelay = 26;
    lines.forEach((lineEl, lIdx) => {
      const chars = Array.from(lineEl.querySelectorAll('.char'));
      chars.forEach((c, i) => {
        const d = revealDelay * (i + (lIdx * 6));
        setTimeout(() => c.classList.add('visible'), d);
      });
    });
  }

  async function runSequence() {
    if (prefersReduced) {
      // show final immediately
      // ensure typing element hidden and final revealed
      typingEl.style.display = 'none';
      revealFinal();
      return;
    }
    const holder = typingEl.querySelector('.typing-text') || typingEl;
    const caret = typingEl.querySelector('.typing-caret');

    for (let p = 0; p < phrases.length; p++) {
      const ok = await typeText(holder, phrases[p]);
      if (!ok) return;
      // small pause after typing each word
      await wait(600 + Math.floor(Math.random() * 300));
      // delete the word completely (per-word deletion illusion)
      const ok2 = await deleteText(holder);
      if (!ok2) return;
      // brief pause before next word
      await wait(220);
    }

    // after cycling words, reveal assembled full phrase
    typingEl.classList.add('fade-out');
    await wait(360);
    typingEl.style.display = 'none';
    revealFinal();
  }

  // start animation, but stop if intro already dismissed
  if (!aborted()) runSequence().catch((e) => console.error('[intro] typing error', e));

  // ensure we don't keep timers running when user dismisses via skip
  const observer = new MutationObserver(() => {
    if (aborted()) {
      // reveal final quickly
      typingEl.style.display = 'none';
      fullPhrase.classList.add('show');
      // reveal all chars immediately
      fullPhrase.querySelectorAll('.char').forEach(c => c.classList.add('visible'));
      observer.disconnect();
    }
  });
  observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });

  introBtn.addEventListener('click', () => { 
    fullPhrase.style.display = 'none';
  });
}

function typingNormal() {
  const rideauG = document.querySelector('.rideau.gauche');
  const rideauD = document.querySelector('.rideau.droite');
  const introText = document.querySelector('.intro-text');
  const accueil = document.getElementById('accueil-content');
  const introBtn = document.querySelector('.intro-btn');
  const introBG = document.querySelector('.intro-gradient-bg') || document.getElementById('intro-bg') || document.querySelector('.intro-bg');

  if (!introText || !accueil) return;

  // Grab lines (we'll use the first paragraph for the cycling primary phrase)
  const lines = Array.from(introText.querySelectorAll('p'));
  if (!lines.length) return;

  // caret element
  const caret = document.createElement('span');
  caret.className = 'typing-caret';
  caret.setAttribute('aria-hidden', 'true');

  //array phrases to cycle (type -> pause -> delete -> next)
  const PHRASES = ["Bienvenue","à", "l'expotim", "2026"];

  // animation timings
  const TYPING_SPEED = 80; // ms per char
  const DELETING_SPEED = 36; // ms per char when deleting
  const PAUSE_AFTER_TYPE = 900; // ms

  // Make the intro button available immediately so the user can skip the animation
  if (introBtn) {
    introBtn.classList.add('show');
    introBtn.setAttribute('aria-hidden', 'false');
  }

  // Attach caret to the primary line
  const primary = lines[0];
  primary.appendChild(caret);

  // detect reduced-motion once and mark page as running intro (so we can hide header)
  const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!prefersReduced) document.body.classList.add('intro-running');

  // Respect reduced-motion: skip animation and place first phrase
  if (prefersReduced) {
    primary.textContent = PHRASES[0];
    if (introBtn) introBtn.classList.add('show');
    // if reduced motion, don't keep header hidden
    document.body.classList.remove('intro-running');
  } else {
    // Start cycling through phrases
    // allow user to skip/abort the typing early
    let skipped = false;
    function openCurtains() {
      if (openCurtains._ran) return;
      openCurtains._ran = true;
      skipped = true;
      try { caret.remove(); } catch (e) {}
      document.body.classList.add('grid-visible');
      // reveal header now intro is finished/skipped
      document.body.classList.remove('intro-running');
      if (rideauG) rideauG.classList.add('open');
      if (rideauD) rideauD.classList.add('open');
      introText.classList.add('fade-out');
      if (introBG) introBG.classList.add('open');
      accueil.style.opacity = 1;

      if (introBtn) {
        introBtn.classList.remove('show');
        try {
          introBtn.setAttribute('aria-hidden', 'true');
          introBtn.setAttribute('disabled', 'true');
          setTimeout(() => { introBtn.style.display = 'none'; }, 500);
        } catch (e) {}
      }
    }

    // Attach an early click handler so users can skip the animation at any time
    if (introBtn) {
      introBtn.addEventListener('click', () => {
        try { introBtn.classList.add('hide'); } catch (e) {}
        openCurtains();
      }, { once: true });
    }
    let phraseIndex = 0;
    let charPos = 0;

    function typeNextChar() {
      if (skipped) return;
      const current = PHRASES[phraseIndex];
      if (charPos < current.length) {
        caret.insertAdjacentText('beforebegin', current.charAt(charPos));
        charPos++;
        setTimeout(typeNextChar, TYPING_SPEED);
      } else {
        // finished typing this phrase
        setTimeout(() => {
          // if this is the last phrase, finish; otherwise delete then move on
          if (phraseIndex >= PHRASES.length - 1) {
            finishTyping();
          } else {
            deleteChars();
          }
        }, PAUSE_AFTER_TYPE);
      }
    }

    function deleteChars() {
      if (skipped) return;
      const prev = caret.previousSibling;
      if (!prev) {
        // nothing left, move to next phrase
        phraseIndex++;
        charPos = 0;
        setTimeout(typeNextChar, TYPING_SPEED);
        return;
      }
      // If previousSibling is a text node, remove last character
      if (prev.nodeType === Node.TEXT_NODE) {
        const txt = prev.textContent;
        if (txt.length > 1) {
          prev.textContent = txt.slice(0, -1);
        } else {
          // remove the empty node
          prev.remove();
        }
      } else if (prev.nodeType === Node.ELEMENT_NODE) {
        // element node (unlikely), remove its last text child or remove element
        if (prev.lastChild && prev.lastChild.nodeType === Node.TEXT_NODE) {
          const t = prev.lastChild.textContent;
          if (t.length > 1) prev.lastChild.textContent = t.slice(0, -1);
          else prev.remove();
        } else {
          prev.remove();
        }
      }

      // continue deleting until nothing before caret
      // check if there's any characters left before the caret
      const hasChars = caret.previousSibling && (caret.previousSibling.nodeType === Node.TEXT_NODE ? caret.previousSibling.textContent.length > 0 : true);
      if (hasChars) {
        setTimeout(deleteChars, DELETING_SPEED);
      } else {
        // moved to next phrase
        phraseIndex++;
        charPos = 0;
        setTimeout(typeNextChar, TYPING_SPEED + 80);
      }
    }

    // Kick off typing of first phrase
    setTimeout(typeNextChar, 120);
  }

  function finishTyping() {
    // remove caret
    caret.remove();
    // reveal intro button and fade-in if needed
    // keep text visible; the button's click already opens the curtains (attached earlier)
    // also start any previously-defined subtitle cycling if present
    try {
      const subtitle = lines[1];
      if (subtitle && !(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches)) {
        // if earlier code added cycling behaviour, keep it (no-op here)
        subtitle.classList.add('cycled-ready');
      }
    } catch (e) {
      // ignore
    }

    // After the type/delete sequence, show the full assembled phrase with a single entrance animation
    try {
      const fullPhrase = PHRASES.join(' ');
      if (primary) {
        const finalLines = [PHRASES[0] + ' ' + PHRASES[1], PHRASES[2], PHRASES[3]]; // ["Bienvenue à", "l'expotim", "2026"]
        // Build per-letter markup so we can reveal by character index across all three rows
        primary.innerHTML = '';
        const container = document.createElement('span');
        container.className = 'full-phrase';

        // create lines with per-character spans
        const lineEls = finalLines.map((ln, idx) => {
          const line = document.createElement('span');
          line.className = `fp-line fp-line-${idx+1}`;
          // wrap each character in a span.char
          for (let i = 0; i < ln.length; i++) {
            const ch = ln.charAt(i);
            const chEl = document.createElement('span');
            chEl.className = 'char';
            chEl.dataset.idx = i;
            if (ch === ' ') {
              chEl.classList.add('space');
              chEl.textContent = '\u00A0'; // non-breaking space so width is preserved
            } else {
              chEl.textContent = ch;
            }
            line.appendChild(chEl);
          }
          return line;
        });

        lineEls.forEach((el) => {
          container.appendChild(el);
        });

        // append container
        primary.appendChild(container);

        // reveal sequence: letters appear column-by-column across all lines
        if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
          // reduced motion: reveal immediately
          lineEls.forEach(line => {
            Array.from(line.querySelectorAll('.char')).forEach(c => c.classList.add('visible'));
          });
          if (container) container.classList.add('show');
        } else {
          const maxLen = Math.max(...finalLines.map(s => s.length));
          const PER_COL_MS = 60; // time between each character-column reveal
          for (let col = 0; col < maxLen; col++) {
            setTimeout(() => {
              lineEls.forEach(line => {
                const ch = line.querySelector(`.char[data-idx="${col}"]`);
                if (ch) ch.classList.add('visible');
              });
            }, col * PER_COL_MS);
          }
          // also add .show to container to run any container-level effects
          setTimeout(() => container.classList.add('show'), 10);
        }
      }
    } catch (err) {
      // ignore animation errors
      console.warn('erreur anim full', err);
    }
  }

  // start typing
  //setTimeout(typeStep, 80); // small initial delay for effect
}

