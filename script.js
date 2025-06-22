$(()=>{
    $(document).ready(function() {
    let debounceTimer;
    let selectedIndex = -1;
    
    // Fix: Extract kategori properly by removing " Tracker" from the text
    const kategori = $('#kategori').text().replace(' Tracker', '').trim();
    console.log('Kategori detected:', kategori);
    
    $('#konsumsi').on('input', function() {
        const query = $(this).val();
        console.log('Input value:', query);
        
        clearTimeout(debounceTimer);
        selectedIndex = -1;
        
        if (query.length < 2) {
            $('#suggestions').hide().empty();
            return;
        }
        
        // Debounce to avoid too many requests
        debounceTimer = setTimeout(function() {
            console.log('Searching for:', query, 'in category:', kategori);
            searchFood(query, kategori);
        }, 300);
    });
    
    // Keyboard navigation for suggestions
    $('#konsumsi').on('keydown', function(e) {
        const $suggestions = $('.suggestion-item');
        
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            selectedIndex = Math.min(selectedIndex + 1, $suggestions.length - 1);
            updateSelection($suggestions);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            selectedIndex = Math.max(selectedIndex - 1, -1);
            updateSelection($suggestions);
        } else if (e.key === 'Enter' && selectedIndex >= 0) {
            e.preventDefault();
            $suggestions.eq(selectedIndex).click();
        } else if (e.key === 'Escape') {
            $('#suggestions').hide();
            selectedIndex = -1;
        }
    });
    
    // Handle suggestion click
    $(document).on('click', '.suggestion-item', function() {
        const foodName = $(this).data('food-name');
        $('#konsumsi').val(foodName);
        $('#suggestions').hide();
        selectedIndex = -1;
        // Fix: Changed from #bobot to #berat to match your HTML
        $('#berat').focus();
    });
    
    // Hide suggestions when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.autocomplete-container').length) {
            $('#suggestions').hide();
            selectedIndex = -1;
        }
    });
    
    // Function to search food via AJAX
    function searchFood(query, kategori) {
        console.log('Making AJAX request...');
        $.ajax({
            url: '?c=Calories&m=searchFood',
            method: 'GET', // Changed to uppercase for consistency
            data: {
                q: query,
                kategori: kategori
            },
            dataType: 'json',
            timeout: 10000, // Add timeout
            beforeSend: function() {
                console.log('AJAX request sent');
            },
            success: function(data) {
                console.log('AJAX success:', data);
                displaySuggestions(data);
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error - Status:', status);
                console.log('AJAX Error - Error:', error);
                console.log('AJAX Error - Response:', xhr.responseText);
                console.log('AJAX Error - Status Code:', xhr.status);
                
                // Try to parse error response
                try {
                    const errorData = JSON.parse(xhr.responseText);
                    console.log('Parsed error data:', errorData);
                } catch (e) {
                    console.log('Could not parse error response as JSON');
                }
                
                $('#suggestions').hide();
            }
        });
    }
    
    // Function to display suggestions
    function displaySuggestions(suggestions) {
        console.log('Displaying suggestions:', suggestions);
        const $suggestionsDiv = $('#suggestions');
        $suggestionsDiv.empty();
        
        if (!suggestions || suggestions.length === 0) {
            console.log('No suggestions to display');
            $suggestionsDiv.hide();
            return;
        }
        
        suggestions.forEach(function(item, index) {
            console.log('Adding suggestion:', item);
            const $suggestion = $('<div class="suggestion-item">')
                .html(
                    '<div class="food-name">' + escapeHtml(item.food) + '</div>' +
                    '<div class="food-calories">' + item.calories + ' kal/100g</div>'
                )
                .data('food-name', item.food)
                .data('calories', item.calories);
            
            $suggestionsDiv.append($suggestion);
        });
        
        console.log('Showing suggestions dropdown');
        $suggestionsDiv.show();
    }
    
    // Function to update keyboard selection
    function updateSelection($suggestions) {
        $suggestions.removeClass('active');
        if (selectedIndex >= 0) {
            $suggestions.eq(selectedIndex).addClass('active');
        }
    }
    
    // Function to escape HTML (security)
    function escapeHtml(text) {
        if (!text) return '';
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.toString().replace(/[&<>"']/g, function(m) { return map[m]; });
    }
});
});