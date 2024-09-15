<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Search with PHP & JavaScript</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; }
        .search-container { max-width: 400px; margin: 50px auto; }
        .search-input { width: 100%; padding: 10px; font-size: 18px; }
        .results { border: 1px solid #ccc; margin-top: 5px; }
        .result-item { padding: 10px; border-bottom: 1px solid #eee; }
        .result-item:last-child { border-bottom: none; }
        .result-item:hover { background-color: #f0f0f0; cursor: pointer; }
    </style>
</head>
<body>

<div class="search-container">
    <h2>Live Search</h2>
    <input type="text" class="search-input" placeholder="Search for products..." id="search">
    <div class="results" id="results"></div>
</div>

<script>
document.getElementById('search').addEventListener('input', function() {
    let query = this.value;

    if (query.length > 0) {
        fetch(`search.php?query=${query}`)
            .then(response => response.json())
            .then(data => {
                let resultsDiv = document.getElementById('results');
                resultsDiv.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(product => {
                        resultsDiv.innerHTML += `<div class="result-item">
                            <i class="fas fa-box"></i> ${product.name} - $${product.price}
                        </div>`;
                    });
                } else {
                    resultsDiv.innerHTML = '<p>No results found</p>';
                }
            });
    } else {
        document.getElementById('results').innerHTML = '';
    }
});
</script>

</body>
</html>