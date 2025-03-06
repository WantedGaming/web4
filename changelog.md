# Changelog

All notable changes to the Game Database project will be documented in this file.

Default image placeholder for missing icon:
https://placehold.co/600x400/transparent/ff4d01?text=No\nImage

## [1.5.9] - 2025-03-06

### Changed
- Updated armor-list.php to make the entire armor card clickable (both icon and name)
- Added styling for armor-name-link similar to weapon-name-link
- Updated the armor card on the homepage to make the entire card clickable, similar to the weapon card
- These changes make the armor elements consistent with the weapon elements for better user experience

## [1.5.8] - 2025-03-06

### Changed
- Simplified site structure by removing weapons.php, keeping only weapon-list.php
- This change makes the weapons section consistent with the armor section

## [1.5.7] - 2025-03-06

### Added
- Created armor-list.php page to display a filterable list of armor items
- Added links to armor-list.php in the top navigation and main card on the homepage
- Implemented filtering by class, type, material, and grade
- Added pagination for browsing through large sets of armor data
- Implemented placeholder images for armor items without icons

## [1.5.6] - 2025-03-06

### Changed
- Updated weapon-detail.php and weapon-list.php pages:
  - Removed special prefixes like "\aG" or "\aH" from weapon names
  - Added cleanWeaponName() function to functions.php to handle the prefix removal
  - This change makes weapon names cleaner and more consistent with the game's UI

## [1.5.5] - 2025-03-06

### Added
- Added "Location" section to weapon-detail.php page:
  - Displays spawn locations of monsters that drop the weapon
  - Shows location name and the monster that spawns there
  - Uses data from spawnlist_npc and mapids tables
  - Positioned under the "Dropped By" section

## [1.5.4] - 2025-03-06

### Changed
- Updated weapon-detail.php page:
  - Removed "+" prefix from stat labels in the Bonus section (HIT, DMG, STR, CON, DEX, INT, WIS, CHA, HP, MP, HPR, MPR, SP, MR)
  - This change makes the stat labels cleaner and more consistent with the game's UI

## [1.5.3] - 2025-03-06

### Changed
- Updated weapon-detail.php page:
  - Changed card background color to match the website background color
  - Updated all card elements to use var(--bg-color-primary) instead of var(--bg-color-tertiary)

## [1.5.2] - 2025-03-06

### Added
- Added "Dropped By" section to weapon-detail.php page:
  - Displays monsters that drop the weapon
  - Shows monster name, level, and drop chance percentage
  - Positioned under the "Bonus" section

## [1.5.1] - 2025-03-06

### Added
- Enhanced "Bonus" card in weapon-detail.php page with additional attributes:
  - Double DMG (double_dmg_chance)
  - Magic DMG (magicdmgmodifier)
  - Skill HIT (hitup_skill)
  - Spirit HIT (hitup_spirit)
  - Dragon HIT (hitup_dragon)
  - Fear HIT (hitup_fear)
  - All HIT (hitup_all)
  - Magic HIT (hitup_magic)
  - Reduce DMG (damage_reduction)
  - Ignore DMG-R (reductionEgnor)
  - Melee Crit (shortCritical)
  - Range Crit (longCritical)
  - Magic Crit (magicCritical)
  - Ignore Immune (imunEgnor)
  - Stun Duration (stunDuration)
  - Triple Arrow Stun (tripleArrowStun)
  - Procs (Magic_name)

## [1.5.0] - 2025-03-06

### Changed
- Removed yellow glow effect from blessed weapon icons on weapon-detail.php page

## [1.4.9] - 2025-03-06

### Added
- Added "Can Not" section to weapon-detail.php page:
  - Displays weapon restrictions including Delete, Sell, Trade, Storage, and Special Storage
  - Shows only applicable restrictions for each weapon
  - Positioned next to the "Used by" section for better layout
  - Added responsive design for mobile devices
- Added yellow glow effect to weapon icons for blessed items (bless=1)

## [1.4.8] - 2025-03-06

### Added
- Added "Bonus" card to weapon-detail.php page:
  - Displays weapon stat modifiers including +HIT, +DMG, +STR, +CON, +DEX, +INT, +WIS, +CHA, +HP, +MP, +HPR, +MPR, +SP, and +MR
  - Shows only non-zero values with proper formatting
  - Styled to match the existing "Used by" section
  - Added responsive design for the bonus section

## [1.4.7] - 2025-03-06

### Changed
- Updated weapon-detail.php page layout:
  - Added card-style containers for better visual organization
  - Created separate cards for weapon icon and information
  - Changed "Basic Information & Combat Stats" heading to "Info" for better readability
  - Increased weapon icon size from 64px to 196px for better visibility
  - Removed border around the weapon icon for cleaner appearance

## [1.4.6] - 2025-03-06

### Changed
- Updated weapon-detail.php page layout:
  - Moved weapon icon to its own dedicated box
  - Combined "Basic Information" and "Combat Stats" sections into a single box
  - Changed "Classes That Can Use This Weapon" heading to "Used by" for better readability

## [1.4.5] - 2025-03-06

### Added
- Created weapon-detail.php page to display detailed information about individual weapons
- Added links to each weapon in the weapon-list.php table to navigate to the detail page
- Implemented weapon detail view with comprehensive information including basic stats, combat stats, and class requirements
- Added breadcrumb navigation for better user experience
- Added styling for weapon detail page with responsive design

## [1.4.4] - 2025-03-06

### Added
- Implemented placeholder image for weapons without icons in weapon-list.php
- Added file existence check to display placeholder for missing weapon icons

## [1.4.3] - 2025-03-06

### Fixed
- Fixed database connection error by updating database name in config/database.php
- Created weapons.php page with proper error handling

## [1.4.2] - 2025-03-06

### Added
- Added weapons list to weapons.php page with data from the database
- Implemented pagination showing 20 weapons per page
- Added weapon categories section based on database data
- Added table view for weapons with icons, name, type, material, and stats

## [1.4.1] - 2025-03-06

### Fixed
- Fixed connection issue with the "Weapon" navigation link by updating it to point to weapons.php

### Changed
- Changed "Weapons" card to "Weapon Card" under Main Categories
- Updated "Weapon Card" link to point to weapons.php instead of weapon-list.php
- Made the entire "Weapon Card" clickable instead of just the link text

## [1.4.0] - 2025-03-06

### Added
- Added weapon listing page that displays detailed weapon information from the database
- Implemented pagination system showing 20 weapons per page
- Added filtering functionality by class, type, material, and grade
- Created weapon detail display with icons from assets/img/icons folder

## [1.3.1] - 2025-03-06

### Added
- Added "Doll" card to Main Categories with appropriate placeholder image

## [1.3.0] - 2025-03-06

### Added
- Added placeholder images to all category cards
- Added CSS styling for card images

### Changed
- Changed "Quest Card" to "Items" with appropriate placeholder image
- Updated card display to use image placeholders instead of SVG icons

## [1.2.0] - 2025-03-06

### Added
- Added two new category cards: Quests and Items
- Added two new recent update cards: New Quest Line Added and Seasonal Event Announced

## [1.1.0] - 2025-03-06

### Added
- Created proper folder structure for better organization
- Added CSS directory with extracted styles.css
- Added JS directory with main.js for JavaScript functionality
- Added config directory with database.php and config.php
- Added includes directory with header.php, footer.php, db.php, and functions.php
- Added pages directory for different page templates
- Added API directory with RESTful endpoints
- Created 404.php error page
- Added .htaccess file for URL rewriting and security

### Changed
- Moved inline CSS from design3.html to external stylesheet
- Converted static HTML to PHP templates
- Implemented proper separation of concerns (MVC-like structure)
- Enhanced security with .htaccess rules
- Improved maintainability with modular code organization

### Technical Improvements
- Added database connection and helper functions
- Added utility functions for common tasks
- Implemented clean URL structure with .htaccess
- Added API endpoints for data access
- Enhanced security by protecting sensitive files and directories

## [1.0.0] - 2025-03-06

### Added
- Initial dark theme implementation
- Organized CSS with clear section comments
- Added comprehensive variable system in :root section
- Added gradient text effect for hero title
- Enhanced hover effects for cards and buttons

### Changed
- Converted light theme to dark theme
- Updated color palette to use dark backgrounds (#121212, #1e1e1e, #252525)
- Updated text colors for better contrast on dark backgrounds
- Changed accent color from default blue to orange (#ff4d01)
- Improved card hover states with border color changes
- Enhanced the search bar with a dark background
- Added background colors to different sections for better visual separation

### Technical Improvements
- Grouped related styles together (header, navigation, cards, etc.)
- Used a more logical ordering of styles
- Improved CSS organization and maintainability
- Enhanced shadow effects for better visibility in dark mode
