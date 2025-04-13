<!-- year-selector.blade.php -->
<div class="year-selector">
    <div class="d-flex justify-content-between align-items-center year-navigation">
        <h5><i class="fas fa-calendar-alt"></i> Filter by Years : <span class="year-label"> 2025</span></h5>
        
        <!-- Year Pills -->
        <div class="year-pills" id="yearPills">
            <button class="year-pill active" data-year="2025">2025</button>
            <button class="year-pill" data-year="2024">2024</button>
            <button class="year-pill" data-year="2023">2023</button>
            <button class="year-pill" data-year="2022">2022</button>
            <button class="year-pill" data-year="2021">2021</button>
        </div>
        
        <!-- Year Dropdown (for mobile/overflow) -->
        <div class="year-dropdown">
            <button id="yearDropdownToggle" class="year-dropdown-toggle">
                Select Year <i class="fas fa-chevron-down"></i>
            </button>
            <div id="yearDropdownMenu" class="year-dropdown-menu">
                <!-- Search Input -->
                <div class="year-search">
                    <input type="text" id="yearSearchInput" class="year-search-input" placeholder="Search year...">
                    <i class="fas fa-search year-search-icon"></i>
                </div>
                <!-- Year Options (populated via JS) -->
                <div id="yearDropdownItems"></div>
            </div>
        </div>
    </div>
</div>