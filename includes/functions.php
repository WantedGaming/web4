<?php
/**
 * Utility functions
 */

/**
 * Sanitize output for HTML display
 * 
 * @param string $string String to sanitize
 * @return string Sanitized string
 */
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Redirect to another page
 * 
 * @param string $url URL to redirect to
 * @return void
 */
function redirect($url) {
    header("Location: $url");
    exit;
}

/**
 * Get current page URL
 * 
 * @return string Current page URL
 */
function getCurrentUrl() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * Check if current page is the active page
 * 
 * @param string $page Page to check
 * @return bool True if current page is active
 */
function isActivePage($page) {
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
    return $currentPage === $page;
}

/**
 * Format date
 * 
 * @param string $date Date string
 * @param string $format Date format
 * @return string Formatted date
 */
function formatDate($date, $format = 'F j, Y') {
    return date($format, strtotime($date));
}

/**
 * Truncate text to specified length
 * 
 * @param string $text Text to truncate
 * @param int $length Maximum length
 * @param string $append String to append if truncated
 * @return string Truncated text
 */
function truncate($text, $length = 100, $append = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    
    $text = substr($text, 0, $length);
    $text = substr($text, 0, strrpos($text, ' '));
    
    return $text . $append;
}

/**
 * Remove special prefixes from weapon names
 * 
 * @param string $name Weapon name that may contain prefixes like \aG or \aH
 * @return string Cleaned weapon name without prefixes
 */
function cleanWeaponName($name) {
    // Remove prefixes like \aG or \aH from the beginning of weapon names
    return preg_replace('/^\\\\a[A-Z]/', '', $name);
}

/**
 * Generate pagination links
 * 
 * @param int $currentPage Current page number
 * @param int $totalPages Total number of pages
 * @param string $urlPattern URL pattern with :page placeholder
 * @return string HTML pagination links
 */
function pagination($currentPage, $totalPages, $urlPattern) {
    if ($totalPages <= 1) {
        return '';
    }
    
    $links = '<div class="pagination">';
    
    // Previous link
    if ($currentPage > 1) {
        $links .= '<a href="' . str_replace(':page', $currentPage - 1, $urlPattern) . '" class="pagination-prev">&laquo; Previous</a>';
    } else {
        $links .= '<span class="pagination-prev disabled">&laquo; Previous</span>';
    }
    
    // Page links
    $startPage = max(1, $currentPage - 2);
    $endPage = min($totalPages, $currentPage + 2);
    
    if ($startPage > 1) {
        $links .= '<a href="' . str_replace(':page', 1, $urlPattern) . '" class="pagination-link">1</a>';
        if ($startPage > 2) {
            $links .= '<span class="pagination-ellipsis">...</span>';
        }
    }
    
    for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i === $currentPage) {
            $links .= '<span class="pagination-link active">' . $i . '</span>';
        } else {
            $links .= '<a href="' . str_replace(':page', $i, $urlPattern) . '" class="pagination-link">' . $i . '</a>';
        }
    }
    
    if ($endPage < $totalPages) {
        if ($endPage < $totalPages - 1) {
            $links .= '<span class="pagination-ellipsis">...</span>';
        }
        $links .= '<a href="' . str_replace(':page', $totalPages, $urlPattern) . '" class="pagination-link">' . $totalPages . '</a>';
    }
    
    // Next link
    if ($currentPage < $totalPages) {
        $links .= '<a href="' . str_replace(':page', $currentPage + 1, $urlPattern) . '" class="pagination-next">Next &raquo;</a>';
    } else {
        $links .= '<span class="pagination-next disabled">Next &raquo;</span>';
    }
    
    $links .= '</div>';
    
    return $links;
}
