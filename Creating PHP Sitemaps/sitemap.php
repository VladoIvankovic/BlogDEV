<?php
// Define your website's base URL
$base_url = "https://www.example.com/";

// Define the array of URLs to include in the sitemap
$urls = [
    ['loc' => '', 'lastmod' => '2023-06-08', 'changefreq' => 'daily', 'priority' => '1.0'],
    ['loc' => 'about', 'lastmod' => '2023-06-07', 'changefreq' => 'monthly', 'priority' => '0.8'],
    ['loc' => 'contact', 'lastmod' => '2023-06-06', 'changefreq' => 'yearly', 'priority' => '0.5'],
    // Add more URLs as needed
];

// Function to generate XML sitemap
function generateSitemap($base_url, $urls) {
    // Create a new DOMDocument object
    $dom = new DOMDocument('1.0', 'UTF-8');

    // Create the <urlset> root element and add namespace attributes
    $urlset = $dom->createElement('urlset');
    $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    $dom->appendChild($urlset);

    // Loop through each URL and add it to the sitemap
    foreach ($urls as $url) {
        $url_element = $dom->createElement('url');

        // Add <loc> element
        $loc = $dom->createElement('loc', htmlspecialchars($base_url . $url['loc']));
        $url_element->appendChild($loc);

        // Add <lastmod> element
        $lastmod = $dom->createElement('lastmod', $url['lastmod']);
        $url_element->appendChild($lastmod);

        // Add <changefreq> element
        $changefreq = $dom->createElement('changefreq', $url['changefreq']);
        $url_element->appendChild($changefreq);

        // Add <priority> element
        $priority = $dom->createElement('priority', $url['priority']);
        $url_element->appendChild($priority);

        // Append the <url> element to <urlset>
        $urlset->appendChild($url_element);
    }

    // Set the content type to XML and output the XML content
    header('Content-Type: application/xml');
    echo $dom->saveXML();
}

// Call the function to generate the sitemap
generateSitemap($base_url, $urls);
?>
