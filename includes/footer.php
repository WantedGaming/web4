<footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo $siteConfig['site_name']; ?>. All rights reserved.</p>
        </div>
    </footer>

    <script src="<?php echo $siteConfig['site_url']; ?>/js/main.js"></script>
    <?php if (isset($additionalJs) && is_array($additionalJs)): ?>
        <?php foreach ($additionalJs as $js): ?>
            <script src="<?php echo $siteConfig['site_url']; ?>/js/<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
