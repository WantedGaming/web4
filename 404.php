<?php
/**
 * 404 Error Page
 */

// Set page variables
$pageTitle = '404 - Page Not Found';
$pageDescription = 'The page you are looking for could not be found.';
$currentPage = '404';

// Include header
require_once 'includes/header.php';
?>

<section class="hero">
    <div class="container">
        <h1 class="hero-title">404 - Page Not Found</h1>
        <p class="hero-subtitle">The page you are looking for could not be found.</p>
        <a href="<?php echo $siteConfig['site_url']; ?>" class="hero-button">Return to Home</a>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="text-align: center; padding: 40px 0;">
            <svg class="svg-icon" style="width: 120px; height: 120px; color: var(--accent-color);" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
            </svg>
            
            <h2 style="margin-top: 20px;">Oops! Something went wrong.</h2>
            <p style="max-width: 600px; margin: 20px auto;">
                The page you're looking for might have been removed, had its name changed, 
                or is temporarily unavailable. Please check the URL for any typos.
            </p>
            
            <div style="margin-top: 40px;">
                <h3>You might want to try:</h3>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="<?php echo $siteConfig['site_url']; ?>">Return to the homepage</a></li>
                    <li><a href="<?php echo $siteConfig['site_url']; ?>/pages/weapons.php">Browse weapons</a></li>
                    <li><a href="<?php echo $siteConfig['site_url']; ?>/pages/armor.php">Browse armor</a></li>
                    <li><a href="<?php echo $siteConfig['site_url']; ?>/pages/monsters.php">Browse monsters</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
require_once 'includes/footer.php';
?>
