<button onclick="scrollToTop()" id="scrollTopBtn" title="Remonter en haut">
    <svg viewBox="0 0 24 24">
        <path d="M12 4l-8 8h6v8h4v-8h6z" />
    </svg>
</button>
<script type="text/javascript" src="js/script.js"></script>
<script>
    window.addEventListener('scroll', () => {
        const btn = document.getElementById("scrollTopBtn");
        if (window.scrollY > 250) {
            btn.classList.add("show");
        } else {
            btn.classList.remove("show");
        }
    });

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }
</script>
<footer>
    <div class="item1">
        <h2>Subscribe for Updates</h2>
        <p>Stay up to date with the latest news and offers</p>
    </div>
    <div class="item2">
        <h4>News letter</h4>
        <form id="newsletterForm" action="subscribe.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit" class="subscribe">Subscribe</button>
        </form>
        <h5>We won't spam you</h5>
    </div>
</footer>