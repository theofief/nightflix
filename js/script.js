document.addEventListener('DOMContentLoaded', () => {
    // 🌙🌞 Gestion du mode sombre
    const toggleButton = document.getElementById('mode-toggle');
    const isDark = localStorage.getItem('theme') === 'dark';
  
    if (isDark) {
      document.body.classList.add('dark-mode');
      toggleButton.textContent = 'Light mode';
    }
  
    toggleButton?.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      const isDarkMode = document.body.classList.contains('dark-mode');
      toggleButton.textContent = isDarkMode ? 'Light mode' : 'Dark mode';
      localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
    });

    const quote = document.getElementById('quote');

    if (quote) {
      fetch('quote-proxy.php')
        .then(response => response.json())
        .then(data => {
          const quoteText = data[0].q;
          const quoteAuthor = data[0].a;
          quote.innerHTML = `
            <h4>Today's quote</h4>
            <p>${quoteText}</p>
            <p class="author">- ${quoteAuthor}</p>
          `;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération de la citation :', error);
        });
    }

    const sidenav = document.getElementById("mySidenav");
    const openBtn = document.getElementById("openBtn");
    const closeBtn = document.getElementById("closeBtn");
    let menuOpen = false;
  
    const openNav = () => {
      sidenav.classList.add("active");
      openBtn.classList.add("rotate");
  
      setTimeout(() => {
        openBtn.style.display = "none";
        openBtn.classList.remove("rotate");
      }, 600);
  
      closeBtn.style.display = "block";
      closeBtn.classList.add("rotate");
  
      setTimeout(() => {
        closeBtn.classList.remove("rotate");
      }, 600);
  
      menuOpen = true;
    };
  
    const closeNav = () => {
      sidenav.classList.remove("active");
  
      closeBtn.classList.add("rotate");
      setTimeout(() => {
        closeBtn.style.display = "none";
        closeBtn.classList.remove("rotate");
      }, 600);
  
      openBtn.style.display = "block";
      openBtn.classList.add("rotate");
      setTimeout(() => {
        openBtn.classList.remove("rotate");
      }, 600);
  
      menuOpen = false;
    };
  
    const toggleItemDisplay = () => {
      closeBtn.style.display = (window.innerWidth < 768 && menuOpen) ? "block" : "none";
    };
  
    openBtn?.addEventListener("click", openNav);
    closeBtn?.addEventListener("click", closeNav);
  
    toggleItemDisplay();
    window.addEventListener("resize", toggleItemDisplay);
});