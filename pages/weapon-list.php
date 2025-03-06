<?php
/**
 * Weapon List page
 */

// Set page variables
$pageTitle = 'Weapon List';
$pageDescription = 'Browse all weapons in the database with detailed information.';
$currentPage = 'weapons';

// Include header and required files
require_once '../includes/header.php';
require_once '../includes/functions.php';
require_once '../includes/db.php';

// Pagination settings
$itemsPerPage = 20;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Get filter parameters
$classFilter = isset($_GET['class']) ? $_GET['class'] : '';
$typeFilter = isset($_GET['type']) ? $_GET['type'] : '';
$materialFilter = isset($_GET['material']) ? $_GET['material'] : '';
$gradeFilter = isset($_GET['grade']) ? $_GET['grade'] : '';

// Build filter conditions
$filterConditions = '';
$filterParams = [];

if (!empty($classFilter)) {
    // Add class filter condition based on the use_* columns
    $filterConditions .= " AND use_$classFilter = 1";
}

if (!empty($typeFilter)) {
    $filterConditions .= " AND type = :type";
    $filterParams[':type'] = $typeFilter;
}

if (!empty($materialFilter)) {
    $filterConditions .= " AND material = :material";
    $filterParams[':material'] = $materialFilter;
}

if (!empty($gradeFilter)) {
    $filterConditions .= " AND itemGrade = :grade";
    $filterParams[':grade'] = $gradeFilter;
}

// Build filter query string for pagination links
$filterQueryString = '';
if (!empty($classFilter)) $filterQueryString .= "&class=" . urlencode($classFilter);
if (!empty($typeFilter)) $filterQueryString .= "&type=" . urlencode($typeFilter);
if (!empty($materialFilter)) $filterQueryString .= "&material=" . urlencode($materialFilter);
if (!empty($gradeFilter)) $filterQueryString .= "&grade=" . urlencode($gradeFilter);

// Get total count for pagination
$countQuery = "SELECT COUNT(*) FROM weapon WHERE 1=1" . $filterConditions;
$totalItems = fetchValue($countQuery, $filterParams);
$totalPages = ceil($totalItems / $itemsPerPage);

// Get weapons data
$query = "SELECT item_id, iconId, desc_en, type, material, dmg_small, dmg_large, safenchant 
          FROM weapon 
          WHERE 1=1" . $filterConditions . "
          ORDER BY item_id ASC
          LIMIT " . $itemsPerPage . " OFFSET " . $offset;
$weapons = fetchAll($query, $filterParams);

// Helper function to remove Korean text from material
function removeMaterialKoreanText($material) {
    // Remove text in parentheses which contains Korean characters
    return preg_replace('/\([^)]*\)/', '', $material);
}

// Get unique values for filter dropdowns
$classOptions = [
    'royal' => 'Royal',
    'knight' => 'Knight',
    'elf' => 'Elf',
    'mage' => 'Mage',
    'darkelf' => 'Dark Elf',
    'dragonknight' => 'Dragon Knight',
    'illusionist' => 'Illusionist',
    'warrior' => 'Warrior',
    'fencer' => 'Fencer',
    'lancer' => 'Lancer'
];

$typeQuery = "SELECT DISTINCT type FROM weapon ORDER BY type";
$types = fetchAll($typeQuery);

$materialQuery = "SELECT DISTINCT material FROM weapon ORDER BY material";
$materials = fetchAll($materialQuery);

$gradeQuery = "SELECT DISTINCT itemGrade FROM weapon ORDER BY FIELD(itemGrade, 'ONLY', 'MYTH', 'LEGEND', 'HERO', 'RARE', 'ADVANC', 'NORMAL')";
$grades = fetchAll($gradeQuery);
?>

<section class="hero">
    <div class="container">
        <h1 class="hero-title">Weapon Database</h1>
        <p class="hero-subtitle">Browse all weapons with detailed information including stats and requirements.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <!-- Filter Form -->
        <div class="filter-container">
            <h2 class="section-title">Filter Weapons</h2>
            <form method="GET" action="" class="filter-form">
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="class">Class:</label>
                        <select name="class" id="class">
                            <option value="">All Classes</option>
                            <?php foreach ($classOptions as $value => $label): ?>
                                <option value="<?php echo h($value); ?>" <?php echo $classFilter === $value ? 'selected' : ''; ?>>
                                    <?php echo h($label); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="type">Type:</label>
                        <select name="type" id="type">
                            <option value="">All Types</option>
                            <?php foreach ($types as $type): ?>
                                <option value="<?php echo h($type['type']); ?>" <?php echo $typeFilter === $type['type'] ? 'selected' : ''; ?>>
                                    <?php echo h($type['type']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="material">Material:</label>
                        <select name="material" id="material">
                            <option value="">All Materials</option>
                            <?php foreach ($materials as $material): ?>
                                <option value="<?php echo h($material['material']); ?>" <?php echo $materialFilter === $material['material'] ? 'selected' : ''; ?>>
                                    <?php echo h(removeMaterialKoreanText($material['material'])); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="grade">Grade:</label>
                        <select name="grade" id="grade">
                            <option value="">All Grades</option>
                            <?php foreach ($grades as $grade): ?>
                                <option value="<?php echo h($grade['itemGrade']); ?>" <?php echo $gradeFilter === $grade['itemGrade'] ? 'selected' : ''; ?>>
                                    <?php echo h($grade['itemGrade']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="filter-button">Apply Filters</button>
                    <a href="weapon-list.php" class="reset-button">Reset Filters</a>
                </div>
            </form>
        </div>
        
        <!-- Weapons Table -->
        <h2 class="section-title">Weapons (<?php echo $totalItems; ?> found)</h2>
        
        <?php if (count($weapons) > 0): ?>
            <div class="table-responsive">
                <table class="weapons-table">
                    <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Material</th>
                            <th>Small</th>
                            <th>Large</th>
                            <th>Safe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($weapons as $weapon): ?>
                        <tr>
                            <td class="icon-cell">
                                <?php 
                                $iconPath = "../assets/img/icons/{$weapon['iconId']}.png";
                                $iconSrc = file_exists($iconPath) ? $iconPath : "https://placehold.co/600x400/transparent/ff4d01?text=No\nImage";
                                ?>
                                <a href="weapon-detail.php?id=<?php echo $weapon['item_id']; ?>">
                                    <img src="<?php echo $iconSrc; ?>" alt="Weapon Icon" class="weapon-icon">
                                </a>
                            </td>
                            <td>
                                <a href="weapon-detail.php?id=<?php echo $weapon['item_id']; ?>" class="weapon-name-link">
                                    <?php echo h(cleanWeaponName($weapon['desc_en'])); ?>
                                </a>
                            </td>
                            <td><?php echo h($weapon['type']); ?></td>
                            <td><?php echo h(removeMaterialKoreanText($weapon['material'])); ?></td>
                            <td><?php echo h($weapon['dmg_small']); ?></td>
                            <td><?php echo h($weapon['dmg_large']); ?></td>
                            <td><?php echo h($weapon['safenchant']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <?php echo pagination($currentPage, $totalPages, "?page=:page" . $filterQueryString); ?>
            <?php endif; ?>
        <?php else: ?>
            <div class="no-results">
                <p>No weapons found matching your criteria. Please try different filters.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* Additional styles for the weapon list page */
.filter-container {
    background-color: var(--bg-color-secondary);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 30px;
    border: 1px solid var(--border-color);
}

.filter-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.filter-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.filter-group {
    flex: 1;
    min-width: 200px;
}

.filter-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
}

.filter-group select {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid var(--border-color);
    background-color: var(--bg-color-tertiary);
    color: var(--text-primary);
    font-size: 0.9rem;
}

.filter-actions {
    display: flex;
    gap: 10px;
}

.filter-button, .reset-button {
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.filter-button {
    background-color: var(--accent-color);
    color: white;
    border: none;
}

.filter-button:hover {
    background-color: var(--accent-color-hover);
}

.reset-button {
    background-color: transparent;
    color: var(--text-primary);
    border: 1px solid var(--border-color);
    text-align: center;
}

.reset-button:hover {
    background-color: var(--bg-color-tertiary);
}

.table-responsive {
    overflow-x: auto;
    margin-bottom: 30px;
}

.weapons-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
}

.weapons-table th, .weapons-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.weapons-table th {
    background-color: var(--bg-color-secondary);
    font-weight: 600;
    color: var(--text-primary);
}

.weapons-table tr:hover {
    background-color: var(--bg-color-secondary);
}

.icon-cell {
    width: 50px;
    text-align: center;
}

.weapon-icon {
    width: 32px;
    height: 32px;
    object-fit: contain;
}

.pagination {
    display: flex;
    justify-content: center;
    gap: 5px;
    margin-top: 30px;
}

.pagination-link, .pagination-prev, .pagination-next, .pagination-ellipsis {
    padding: 8px 12px;
    border-radius: 4px;
    background-color: var(--bg-color-secondary);
    color: var(--text-primary);
    text-decoration: none;
    transition: all 0.2s ease;
}

.pagination-link:hover, .pagination-prev:hover, .pagination-next:hover {
    background-color: var(--bg-color-tertiary);
}

.pagination-link.active {
    background-color: var(--accent-color);
    color: white;
}

.pagination .disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.no-results {
    padding: 30px;
    text-align: center;
    background-color: var(--bg-color-secondary);
    border-radius: 8px;
    color: var(--text-secondary);
}

.weapon-name-link {
    color: var(--text-primary);
    text-decoration: none;
    transition: color 0.2s ease;
}

.weapon-name-link:hover {
    color: var(--accent-color);
}
</style>

<?php
// Include footer
require_once '../includes/footer.php';
?>
