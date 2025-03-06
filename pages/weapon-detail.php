<?php
/**
 * Weapon Detail page
 */

// Set page variables
$pageTitle = 'Weapon Detail';
$pageDescription = 'View detailed information about a specific weapon.';
$currentPage = 'weapons';

// Include header and required files
require_once '../includes/header.php';
require_once '../includes/functions.php';
require_once '../includes/db.php';

// Get weapon ID from URL parameter
$weaponId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// If no ID provided, redirect to weapon list
if ($weaponId <= 0) {
    header('Location: weapon-list.php');
    exit;
}

// Get weapon data
$query = "SELECT * FROM weapon WHERE item_id = :id";
$params = [':id' => $weaponId];
$weapon = fetchOne($query, $params);

// If weapon not found, show error message
if (!$weapon) {
    echo '<div class="container"><div class="error-message">Weapon not found. <a href="weapon-list.php">Return to weapon list</a>.</div></div>';
    require_once '../includes/footer.php';
    exit;
}

// Helper function to remove Korean text from material
function removeMaterialKoreanText($material) {
    // Remove text in parentheses which contains Korean characters
    return preg_replace('/\([^)]*\)/', '', $material);
}

// Format weapon properties for display
$material = !empty($weapon['material']) ? removeMaterialKoreanText($weapon['material']) : 'N/A';
$weight = !empty($weapon['weight']) ? $weapon['weight'] : 'N/A';
$itemGrade = !empty($weapon['itemGrade']) ? $weapon['itemGrade'] : 'N/A';

// Determine which classes can use this weapon
$classesCanUse = [];
$classColumns = [
    'use_royal' => 'Royal',
    'use_knight' => 'Knight',
    'use_elf' => 'Elf',
    'use_mage' => 'Mage',
    'use_darkelf' => 'Dark Elf',
    'use_dragonknight' => 'Dragon Knight',
    'use_illusionist' => 'Illusionist',
    'use_warrior' => 'Warrior',
    'use_fencer' => 'Fencer',
    'use_lancer' => 'Lancer'
];

foreach ($classColumns as $column => $className) {
    if (isset($weapon[$column]) && $weapon[$column] == 1) {
        $classesCanUse[] = $className;
    }
}
?>

<section class="hero">
    <div class="container">
        <h1 class="hero-title">Weapon Detail</h1>
        <p class="hero-subtitle">Detailed information about <?php echo h(cleanWeaponName($weapon['desc_en'])); ?></p>
    </div>
</section>

<section class="section">
    <div class="container">
<div class="breadcrumb">
            <a href="weapon-list.php">Weapons</a> &gt; 
            <span><?php echo h(cleanWeaponName($weapon['desc_en'])); ?></span>
        </div>
        
        <div class="weapon-detail-container">
            <div class="weapon-header">
                <?php 
                $iconPath = "../assets/img/icons/{$weapon['iconId']}.png";
                $iconSrc = file_exists($iconPath) ? $iconPath : "https://placehold.co/600x400/transparent/ff4d01?text=No\nImage";
                ?>
                <div class="weapon-title">
                    <h2><?php echo h(cleanWeaponName($weapon['desc_en'])); ?></h2>
                    <div class="weapon-type"><?php echo h($weapon['type']); ?></div>
                </div>
            </div>
            
            <div class="weapon-stats-container">
                <div class="weapon-icon-section card">
                <div class="weapon-icon-large">
                    <img src="<?php echo $iconSrc; ?>" alt="<?php echo h(cleanWeaponName($weapon['desc_en'])); ?> Icon" class="weapon-detail-icon">
                </div>
                </div>
                
                <div class="weapon-stats-section card">
                    <h3>Info</h3>
                    <table class="weapon-stats-table">
                        <tr>
                            <th>ID:</th>
                            <td><?php echo h($weapon['item_id']); ?></td>
                        </tr>
                        <tr>
                            <th>Type:</th>
                            <td><?php echo h($weapon['type']); ?></td>
                        </tr>
                        <tr>
                            <th>Material:</th>
                            <td><?php echo h($material); ?></td>
                        </tr>
                        <tr>
                            <th>Weight:</th>
                            <td><?php echo h($weight); ?></td>
                        </tr>
                        <tr>
                            <th>Grade:</th>
                            <td><?php echo h($itemGrade); ?></td>
                        </tr>
                        <tr>
                            <th>Damage (Small):</th>
                            <td><?php echo h($weapon['dmg_small']); ?></td>
                        </tr>
                        <tr>
                            <th>Damage (Large):</th>
                            <td><?php echo h($weapon['dmg_large']); ?></td>
                        </tr>
                        <tr>
                            <th>Safe Enchant:</th>
                            <td><?php echo h($weapon['safenchant']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="weapon-sections-container">
                <div class="weapon-classes-section">
                    <h3>Used by</h3>
                    <?php if (!empty($classesCanUse)): ?>
                        <div class="classes-grid">
                            <?php foreach ($classesCanUse as $class): ?>
                                <div class="class-tag"><?php echo h($class); ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>No class information available for this weapon.</p>
                    <?php endif; ?>
                </div>
                
                <div class="weapon-cannot-section">
                    <h3>Can Not</h3>
                    <div class="cannot-grid">
                        <?php
                        $cannotOptions = [
                            'cant_delete' => 'Delete',
                            'cant_sell' => 'Sell',
                            'trade' => 'Trade',
                            'retrieve' => 'Storage',
                            'specialretrieve' => 'Special Storage'
                        ];
                        
                        $hasCannotOptions = false;
                        
                        foreach ($cannotOptions as $column => $label) {
                            if (isset($weapon[$column]) && $weapon[$column] == 1) {
                                $hasCannotOptions = true;
                                echo "<div class=\"cannot-tag\">{$label}</div>";
                            }
                        }
                        
                        if (!$hasCannotOptions) {
                            echo "<p>No restrictions for this weapon.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="weapon-bonus-section card">
                <h3>Bonus</h3>
                <div class="bonus-grid">
                    <?php
                    // Define the bonus fields and their display labels
                    $bonusFields = [
                        'hitmodifier' => 'HIT',
                        'dmgmodifier' => 'DMG',
                        'add_str' => 'STR',
                        'add_con' => 'CON',
                        'add_dex' => 'DEX',
                        'add_int' => 'INT',
                        'add_wis' => 'WIS',
                        'add_cha' => 'CHA',
                        'add_hp' => 'HP',
                        'add_mp' => 'MP',
                        'add_hpr' => 'HPR',
                        'add_mpr' => 'MPR',
                        'add_sp' => 'SP',
                        'm_def' => 'MR',
                        'double_dmg_chance' => 'Double DMG',
                        'magicdmgmodifier' => 'Magic DMG',
                        'hitup_skill' => 'Skill HIT',
                        'hitup_spirit' => 'Spirit HIT',
                        'hitup_dragon' => 'Dragon HIT',
                        'hitup_fear' => 'Fear HIT',
                        'hitup_all' => 'All HIT',
                        'hitup_magic' => 'Magic HIT',
                        'damage_reduction' => 'Reduce DMG',
                        'reductionEgnor' => 'Ignore DMG-R',
                        'shortCritical' => 'Melee Crit',
                        'longCritical' => 'Range Crit',
                        'magicCritical' => 'Magic Crit',
                        'imunEgnor' => 'Ignore Immune',
                        'stunDuration' => 'Stun Duration',
                        'tripleArrowStun' => 'Triple Arrow Stun',
                        'Magic_name' => 'Procs'
                    ];
                    
                    $hasBonuses = false;
                    
                    foreach ($bonusFields as $field => $label) {
                        if (isset($weapon[$field]) && $weapon[$field] != 0) {
                            $hasBonuses = true;
                            $value = $weapon[$field];
                            $displayValue = ($value > 0) ? "+{$value}" : $value;
                            echo "<div class=\"bonus-tag\"><span class=\"bonus-label\">{$label}</span> <span class=\"bonus-value\">{$displayValue}</span></div>";
                        }
                    }
                    
                    if (!$hasBonuses) {
                        echo "<p>No bonus stats available for this weapon.</p>";
                    }
                    ?>
                </div>
            </div>
            
            <div class="weapon-drops-section card">
                <h3>Dropped By</h3>
                <div class="drops-grid">
                    <?php
                    // Get mobs that drop this weapon
                    $dropQuery = "SELECT d.mobname_en, d.moblevel, d.chance, d.mobid FROM droplist d WHERE d.itemId = :id";
                    $dropParams = [':id' => $weaponId];
                    $dropList = fetchAll($dropQuery, $dropParams);
                    
                    if (!empty($dropList)) {
                        foreach ($dropList as $drop) {
                            $dropChance = number_format($drop['chance'] / 100, 2); // Convert to percentage
                            echo "<div class=\"drop-tag\"><span class=\"drop-name\">{$drop['mobname_en']}</span> <span class=\"drop-level\">Lv.{$drop['moblevel']}</span> <span class=\"drop-chance\">{$dropChance}%</span></div>";
                        }
                    } else {
                        echo "<p>No drop information available for this weapon.</p>";
                    }
                    ?>
                </div>
            </div>
            
            <div class="weapon-location-section card">
                <h3>Location</h3>
                <div class="location-grid">
                    <?php
                    // Get locations where mobs that drop this weapon spawn
                    $locationQuery = "
                        SELECT DISTINCT m.locationname, s.mapid, d.mobname_en
                        FROM droplist d
                        JOIN spawnlist_npc s ON d.mobid = s.id
                        JOIN mapids m ON s.mapid = m.mapid
                        WHERE d.itemId = :id
                        ORDER BY m.locationname
                    ";
                    $locationParams = [':id' => $weaponId];
                    $locationList = fetchAll($locationQuery, $locationParams);
                    
                    if (!empty($locationList)) {
                        foreach ($locationList as $location) {
                            echo "<div class=\"location-tag\"><span class=\"location-name\">{$location['locationname']}</span> <span class=\"location-mob\">{$location['mobname_en']}</span></div>";
                        }
                    } else {
                        echo "<p>No location information available for this weapon.</p>";
                    }
                    ?>
                </div>
            </div>
            
            <div class="weapon-actions">
                <a href="weapon-list.php" class="back-button">Back to Weapon List</a>
            </div>
        </div>
    </div>
</section>

<style>
/* Weapon Detail Page Styles */
.breadcrumb {
    margin-bottom: 20px;
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.breadcrumb a {
    color: var(--text-secondary);
    text-decoration: none;
}

.breadcrumb a:hover {
    color: var(--accent-color);
}

.weapon-detail-container {
    background-color: var(--bg-color-secondary);
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
    border: 1px solid var(--border-color);
}

.weapon-header {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
    gap: 20px;
}

.weapon-icon-section {
    display: flex;
    justify-content: center;
}

.card {
    background-color: var(--bg-color-primary);
    border-radius: 8px;
    padding: 20px;
    border: 1px solid var(--border-color);
}

.weapon-icon-large {
    background-color: var(--bg-color-primary);
    border-radius: 8px;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.weapon-detail-icon {
    width: 196px;
    height: 196px;
    object-fit: contain;
}

.weapon-title h2 {
    margin: 0 0 5px 0;
    font-size: 1.8rem;
}

.weapon-type {
    color: var(--text-secondary);
    font-size: 1.1rem;
}

.weapon-stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 30px;
}

.weapon-stats-section h3 {
    margin-top: 0;
    margin-bottom: 15px;
    font-size: 1.3rem;
    color: var(--accent-color);
}

.weapon-stats-table {
    width: 100%;
    border-collapse: collapse;
}

.weapon-stats-table th, .weapon-stats-table td {
    padding: 10px 0;
    border-bottom: 1px solid var(--border-color);
    text-align: left;
}

.weapon-stats-table th {
    font-weight: 600;
    width: 40%;
    color: var(--text-primary);
}

.weapon-stats-table td {
    color: var(--text-secondary);
}

.weapon-sections-container {
    display: flex;
    gap: 30px;
    margin-bottom: 30px;
}

.weapon-classes-section, .weapon-cannot-section {
    flex: 1;
}

.weapon-classes-section h3, .weapon-cannot-section h3 {
    margin-top: 0;
    margin-bottom: 15px;
    font-size: 1.3rem;
    color: var(--accent-color);
}

.classes-grid, .cannot-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.class-tag, .cannot-tag {
    background-color: var(--bg-color-primary);
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 0.9rem;
    border: 1px solid var(--border-color);
}


@media (max-width: 768px) {
    .weapon-sections-container {
        flex-direction: column;
    }
}

.weapon-bonus-section {
    margin-bottom: 30px;
}

.weapon-bonus-section h3 {
    margin-top: 0;
    margin-bottom: 15px;
    font-size: 1.3rem;
    color: var(--accent-color);
}

.bonus-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.bonus-tag {
    background-color: var(--bg-color-primary);
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 0.9rem;
    border: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    min-width: 100px;
}

.bonus-label {
    color: var(--text-secondary);
    margin-right: 10px;
}

.bonus-value {
    color: var(--accent-color);
    font-weight: 600;
}

.weapon-drops-section {
    margin-bottom: 30px;
}

.weapon-drops-section h3 {
    margin-top: 0;
    margin-bottom: 15px;
    font-size: 1.3rem;
    color: var(--accent-color);
}

.drops-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.drop-tag {
    background-color: var(--bg-color-primary);
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 0.9rem;
    border: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    min-width: 200px;
}

.drop-name {
    color: var(--text-primary);
    flex-grow: 1;
}

.drop-level {
    color: var(--text-secondary);
    margin: 0 10px;
}

.drop-chance {
    color: var(--accent-color);
    font-weight: 600;
}

.weapon-location-section {
    margin-bottom: 30px;
}

.weapon-location-section h3 {
    margin-top: 0;
    margin-bottom: 15px;
    font-size: 1.3rem;
    color: var(--accent-color);
}

.location-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.location-tag {
    background-color: var(--bg-color-primary);
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 0.9rem;
    border: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-width: 200px;
}

.location-name {
    color: var(--text-primary);
    font-weight: 600;
}

.location-mob {
    color: var(--text-secondary);
    font-size: 0.85rem;
    margin-left: 10px;
}

.weapon-actions {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

.back-button {
    background-color: var(--accent-color);
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
}

.back-button:hover {
    background-color: var(--accent-color-hover);
}

.error-message {
    background-color: var(--bg-color-secondary);
    border-radius: 8px;
    padding: 20px;
    margin: 30px 0;
    text-align: center;
    border: 1px solid var(--border-color);
}

.error-message a {
    color: var(--accent-color);
    text-decoration: none;
}

.error-message a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .weapon-header {
        flex-direction: column;
        text-align: center;
    }
    
    .weapon-stats-container {
        grid-template-columns: 1fr;
    }
}
</style>

<?php
// Include footer
require_once '../includes/footer.php';
?>
