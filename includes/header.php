<?php
/**
 * Header include file
 */
require_once __DIR__ . '/../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' . $siteConfig['site_name'] : $siteConfig['site_name']; ?></title>
    <meta name="description" content="<?php echo isset($pageDescription) ? $pageDescription : $siteConfig['site_description']; ?>">
    <link rel="stylesheet" href="<?php echo $siteConfig['site_url']; ?>/css/styles.css">
    <?php if (isset($additionalCss) && is_array($additionalCss)): ?>
        <?php foreach ($additionalCss as $css): ?>
            <link rel="stylesheet" href="<?php echo $siteConfig['site_url']; ?>/css/<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <div class="logo-icon"></div>
                    <span>GameDB</span>
                </div>
                <nav class="nav">
                    <a href="<?php echo $siteConfig['site_url']; ?>" class="nav-item <?php echo $currentPage === 'home' ? 'active' : ''; ?>">Home</a>
                    <a href="<?php echo $siteConfig['site_url']; ?>/pages/weapon-list.php" class="nav-item <?php echo $currentPage === 'weapons' ? 'active' : ''; ?>">Weapons</a>
                    <a href="<?php echo $siteConfig['site_url']; ?>/pages/armor-list.php" class="nav-item <?php echo $currentPage === 'armor' ? 'active' : ''; ?>">Armor</a>
                    <a href="<?php echo $siteConfig['site_url']; ?>/pages/monsters.php" class="nav-item <?php echo $currentPage === 'monsters' ? 'active' : ''; ?>">Monsters</a>
                    <a href="<?php echo $siteConfig['site_url']; ?>/pages/locations.php" class="nav-item <?php echo $currentPage === 'locations' ? 'active' : ''; ?>">Locations</a>
                </nav>
                <div class="search-bar">
                    <svg class="svg-icon search-icon" viewBox="0 0 24 24">
                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                    <input type="text" class="search-input" placeholder="Search database...">
                </div>
            </div>
        </div>
    </header>
