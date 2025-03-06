<?php
/**
 * Main index file
 */

// Set page variables
$pageTitle = 'Home';
$pageDescription = 'Your comprehensive resource for weapons, armor, monsters, and locations in your favorite games.';
$currentPage = 'home';

// Include header
require_once 'includes/header.php';
?>

<section class="hero">
    <div class="container">
        <h1 class="hero-title">Game Database</h1>
        <p class="hero-subtitle">Your comprehensive resource for weapons, armor, monsters, and locations in your favorite games. Explore detailed stats, find rare items, and dominate the game world.</p>
        <a href="#categories" class="hero-button">Start Exploring</a>
    </div>
</section>

<section id="categories" class="section">
    <div class="container">
        <h2 class="section-title">Main Categories</h2>
        <div class="card-grid">
            <a href="pages/weapon-list.php" class="card-wrapper">
                <div class="card">
                    <div class="card-image">
                        <img src="assets/img/placeholders/weapon_placeholder.png" alt="Weapon Card" class="card-img">
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Weapon Card</h3>
                        <p class="card-text">Browse all weapon types including swords, axes, bows, and magical staves. Find detailed stats and special abilities.</p>
                        <div class="card-link">
                            View Weapon Cards
                            <svg class="svg-icon card-link-icon" viewBox="0 0 24 24" width="16" height="16">
                                <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
            <a href="pages/armor-list.php" class="card-wrapper">
                <div class="card">
                    <div class="card-image">
                        <img src="assets/img/placeholders/armor_placeholder.png" alt="Armor" class="card-img">
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Armor</h3>
                        <p class="card-text">Explore all armor types including helmets, body armor, shields, and magical robes. Find the best protection for your character.</p>
                        <div class="card-link">
                            View Armor
                            <svg class="svg-icon card-link-icon" viewBox="0 0 24 24" width="16" height="16">
                                <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
            <div class="card">
                <div class="card-image">
                    <img src="assets/img/placeholders/monster_placeholder.png" alt="Monsters" class="card-img">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Monsters</h3>
                    <p class="card-text">Search for monsters by level, location, and loot tables. Learn about their weaknesses and best strategies.</p>
                    <a href="pages/monsters.php" class="card-link">
                        View Monsters
                        <svg class="svg-icon card-link-icon" viewBox="0 0 24 24" width="16" height="16">
                            <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-image">
                    <img src="assets/img/placeholders/location_placeholder.png" alt="Locations" class="card-img">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Locations</h3>
                    <p class="card-text">Discover all game locations including towns, dungeons, and special areas. Find hidden treasures and secrets.</p>
                    <a href="pages/locations.php" class="card-link">
                        View Locations
                        <svg class="svg-icon card-link-icon" viewBox="0 0 24 24" width="16" height="16">
                            <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-image">
                    <img src="assets/img/placeholders/items_placeholder.png" alt="Items" class="card-img">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Items</h3>
                    <p class="card-text">Explore all available quests, side missions, and storylines. Find quest rewards and completion requirements.</p>
                    <a href="pages/quests.php" class="card-link">
                        View Items
                        <svg class="svg-icon card-link-icon" viewBox="0 0 24 24" width="16" height="16">
                            <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-image">
                    <img src="assets/img/placeholders/doll_placeholder.png" alt="Dolls" class="card-img">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Doll</h3>
                    <p class="card-text">Explore all available dolls and companions. Find details about their abilities and customization options.</p>
                    <a href="pages/dolls.php" class="card-link">
                        View Dolls
                        <svg class="svg-icon card-link-icon" viewBox="0 0 24 24" width="16" height="16">
                            <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <h2 class="section-title">Recent Updates</h2>
        <div class="card-grid">
            <div class="card update-card">
                <h3 class="update-title">New Weapon Data Added</h3>
                <p class="update-text">Added 25 new weapon entries to the database including Mythical-grade items.</p>
                <p class="update-date">Today</p>
            </div>
            <div class="card update-card">
                <h3 class="update-title">Monster Database Updated</h3>
                <p class="update-text">Updated drop tables for all dungeon monsters with latest patch changes.</p>
                <p class="update-date">Yesterday</p>
            </div>
            <div class="card update-card">
                <h3 class="update-title">Event Items Section Coming Soon</h3>
                <p class="update-text">Development has begun on the Event Items database section, coming next week.</p>
                <p class="update-date">2 days ago</p>
            </div>
            <div class="card update-card">
                <h3 class="update-title">Boss Spawn Alert</h3>
                <p class="update-text">Ancients are spawning in Dragon Valley (Ancient Island) at 11:00.</p>
                <p class="update-date">3 days ago</p>
            </div>
            <div class="card update-card">
                <h3 class="update-title">New Quest Line Added</h3>
                <p class="update-text">The "Forgotten Realms" quest line has been added with 15 new quests and unique rewards.</p>
                <p class="update-date">4 days ago</p>
            </div>
            <div class="card update-card">
                <h3 class="update-title">Seasonal Event Announced</h3>
                <p class="update-text">The Summer Festival event will begin next week with exclusive items and challenges.</p>
                <p class="update-date">5 days ago</p>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
require_once 'includes/footer.php';
?>
