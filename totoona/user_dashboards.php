<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: logins.php"); // Redirect to login page if not logged in
    exit();
}

?>


<html lang="en">
<head>
    <meta name="viewport" content="device-width", initial-scale="1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="user_dashboards.css">
</head>
<body>
    
<body>
<script>
    // Function to clear the content area
    function clearModuleContent() {
        const moduleContent = document.getElementById("module-content");
        moduleContent.innerHTML = ''; // Clear the existing content
    }


 // Function to dashboard content
 function dashboard() {
        clearModuleContent(); // Clear previous module content

        const moduleContent = document.getElementById("module-content");
        moduleContent.innerHTML = `
  <style>
        /* Global Reset */
        .container {
            height: 100vh;
            overflow-y: hidden;
            padding: 20px;
            background-color: #f4f4f4;
            font-family: 'Montserrat', sans-serif;
        }

        /* Dashboard Layout */
        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            width: 100%;
            gap: 20px;
        }

        /* Scrollable Section Styling */
        .scrollable-section {
            max-height: 400px;
            overflow-y: auto;
            padding-right: 10px;
        }

        /* Custom Scrollbar */
        .scrollable-section::-webkit-scrollbar {
            width: 8px;
        }

        .scrollable-section::-webkit-scrollbar-thumb {
            background-color: #007BFF;
            border-radius: 5px;
        }

        .scrollable-section::-webkit-scrollbar-track {
            background-color: #f0f4f8;
        }

        /* Summary card grid layout */
        .row.mt-4 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .summary-card {
            background: linear-gradient(135deg, #007bff, #1e90ff);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .summary-card h4 {
            font-size: 18px;
            color: #ffffff;
            margin-bottom: 10px;
        }

        .summary-card p {
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
        }

        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.25);
        }

        /* Bulletin Board */
        .bulletin-board {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            background-color: #f0f4f8;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        }

        .bulletin-card {
            padding: 20px;
            border-radius: 10px;
            transition: transform 0.3s ease;
            color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .bulletin-card.alert {
            background-color: #ffcccb; /* Light Red */
            border-left: 5px solid red;
        }

        .bulletin-card.event {
            background-color: #d4edda; /* Light Green */
            border-left: 5px solid green;
        }

        .bulletin-card.notice {
            background-color: #cce5ff; /* Light Blue */
            border-left: 5px solid blue;
        }

        .bulletin-card h4 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }

        .bulletin-card p {
            margin-bottom: 10px;
            font-size: 14px;
            color: #555;
        }

        .bulletin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Timeline */
        .timeline {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            background-color: #f8f9fa; /* Light Grey */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .timeline-item {
            background-color: #ffffff;
            border-left: 5px solid #007BFF; /* Blue */
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 15px;
            position: relative;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .timeline-item h4 {
            color: #007bff; /* Darker Blue */
        }

        .timeline-item p {
            color: #333;
        }

        .timeline-item:before {
            content: '';
            position: absolute;
            top: 10px;
            left: -20px;
            height: 15px;
            width: 15px;
            background-color: #007BFF; /* Blue */
            border-radius: 50%;
        }

        /* Quotes Section (Scrollable) */
        .quotes {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 800px;
            margin: 20px auto;
            max-height: 380px;
            overflow-y: auto;
        }

        .quotes h3 {
            margin-bottom: 15px;
            color: #1e90ff; /* Bright Blue */
        }

        .quotes p {
            color: #333;
            font-style: italic;
        }

        /* Custom Scrollbar for Quotes */
        .quotes::-webkit-scrollbar {
            width: 8px;
        }

        .quotes::-webkit-scrollbar-thumb {
            background-color: #007BFF;
            border-radius: 5px;
        }

        .quotes::-webkit-scrollbar-track {
            background-color: #f0f4f8;
        }

    </style>
</head>
<body>
    <p>Welcome, USER!</p>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Dashboard Summary Cards -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="summary-card">
                            <h4>Total Reservations</h4>
                            <p>25</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="summary-card">
                            <h4>Available Facilities</h4>
                            <p>5</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="summary-card">
                            <h4>Reservations Today</h4>
                            <p>3</p>
                        </div>
                    </div>
                </div>

                <div class="dashboard-container">
                    <!-- Scrollable Bulletin Board -->
                    <div class="bulletin-board scrollable-section">
                        <div class="bulletin-card alert">
                            <h4>Electrical Maintenance Notice</h4>
                            <p>Electrical maintenance will be conducted on October 15, 2024. Please plan accordingly.</p>
                        </div>

                        <div class="bulletin-card event">
                            <h4>Community Meeting</h4>
                            <p>Join us for a community meeting on October 20, 2024, at 6 PM.</p>
                        </div>

                        <div class="bulletin-card notice">
                            <h4>New Park Opening</h4>
                            <p>The new park will officially open on October 25, 2024. Come join us for the celebration!</p>
                        </div>

                        <div class="bulletin-card alert">
                            <h4>Waste Collection Day</h4>
                            <p>Don't forget, waste collection is scheduled for October 17, 2024.</p>
                        </div>
                    </div>

                    <!-- Scrollable Timeline Section -->
                    <div class="timeline scrollable-section">
                        <div class="timeline-item">
                            <h4>Electrical Maintenance Notice Posted</h4>
                            <p>October 10, 2024, 10:00 AM</p>
                        </div>

                        <div class="timeline-item">
                            <h4>New Community Center Announcement</h4>
                            <p>October 5, 2024, 2:30 PM</p>
                        </div>

                        <div class="timeline-item">
                            <h4>Barangay Meeting Scheduled</h4>
                            <p>September 30, 2024, 9:45 AM</p>
                        </div>

                        <div class="timeline-item">
                            <h4>New Park Construction Started</h4>
                            <p>September 25, 2024, 11:00 AM</p>
                        </div>
                    </div>

                    <!-- Scrollable Quotes Section -->
                    <div class="quotes scrollable-section">
                        <h3>Quote of the Day</h3>
                        <p>"The best way to predict the future is to create it." - Peter Drucker</p>
                        <p>"Act as if what you do makes a difference. It does." - William James</p>
                        <p>"Success is not how high you have climbed, but how you make a positive difference to the world." - Roy T. Bennett</p>
                        <p>"What lies behind us and what lies before us are tiny matters compared to what lies within us." - Ralph Waldo Emerson</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>`;
 }


 // Function to load Module 1 content
 function loadModule1() {
        clearModuleContent(); // Clear previous module content
        const moduleContent = document.getElementById("module-content");
        moduleContent.innerHTML = `
        <style>
        
        /* Filter and Search */
        .filter-search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-bar input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }

        .filter-dropdown {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Container for the scrollable facilities */
        .facility-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            max-height: 60vh; /* Set maximum height */
            overflow-y: auto; /* Make it scrollable */
            padding-right: 10px; /* Add padding for scrollbar space */
        }

        /* Facility card styles */
        .facility-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: box-shadow 0.3s ease;
            position: relative;
        }

        .facility-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .facility-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .facility-name {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 10px;
        }

        .facility-type {
            font-size: 1em;
            color: #777;
            margin-bottom: 10px;
        }

        .facility-description {
            font-size: 0.9em;
            color: #555;
            margin-bottom: 10px;
        }

        .facility-price {
            font-size: 1.2em;
            color: #27ae60;
            margin-bottom: 10px;
        }

        .facility-availability {
            font-size: 0.9em;
            color: #888;
            margin-bottom: 10px;
        }

        /* Availability status indicator */
        .available {
            color: #28a745;
            font-weight: bold;
        }

        .unavailable {
            color: #dc3545;
            font-weight: bold;
        }

        /* Booking button */
        .book-btn {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .book-btn:hover {
            background-color: #0056b3;
        }

        /* Style for scrollbar */
        .facility-container::-webkit-scrollbar {
            width: 10px;
        }
        .facility-container::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 10px;
        }
        .facility-container::-webkit-scrollbar-track {
            background-color: #f4f4f4;
        }

        /* Responsive adjustments */
        @media(max-width: 600px) {
            .facility-container {
                grid-template-columns: 1fr;
            }

            .filter-search-container {
                flex-direction: column;
                align-items: stretch;
            }

            .search-bar, .filter-dropdown {
                margin-bottom: 10px;
            }
        }
    </style>
    <!-- Filter and Search -->
    <div class="filter-search-container">
        <div class="search-bar">
            <input type="text" placeholder="Search Facility..." id="facilitySearch" oninput="searchFacilities()">
        </div>
        <div class="filter-dropdown">
            <select id="facilityTypeFilter" onchange="filterFacilities()">
                <option value="all">All Types</option>
                <option value="Hall">Hall</option>
                <option value="Room">Room</option>
                <option value="Outdoor Court">Outdoor Court</option>
                <option value="Gym">Gym</option>
            </select>
        </div>
    </div>

    <div class="facility-container" id="facility-list">
        <!-- Facility 1 -->
        <div class="facility-card" data-type="Hall">
    <!-- Correct image path for locally stored image -->
    <img src="brgy.jpg" alt="Community Hall Image" class="facility-image">
    <div class="facility-name">Community Hall</div>
    <div class="facility-type">Hall</div>
    <div class="facility-description">A large community hall perfect for meetings, gatherings, and events.</div>
    <div class="facility-price">₱500 / hour</div>
    <div class="facility-availability available">Available: 9 AM - 6 PM</div>
    <button class="book-btn">book Now</button>
</div>


        <!-- Facility 2 -->
        <div class="facility-card" data-type="Room">
            <img src="confe.jpg" alt="Facility Image" class="facility-image">
            <div class="facility-name">Conference Room</div>
            <div class="facility-type">Room</div>
            <div class="facility-description">Ideal for small meetings, presentations, and work sessions.</div>
            <div class="facility-price">₱300 / hour</div>
            <div class="facility-availability unavailable">Unavailable</div>
            <button class="book-btn" disabled>Book Now</button>
        </div>

        <!-- Facility 3 -->
        <div class="facility-card" data-type="Outdoor Court">
            <img src="kort.jpg" alt="Facility Image" class="facility-image">
            <div class="facility-name">Basketball Court</div>
            <div class="facility-type">Outdoor Court</div>
            <div class="facility-description">Outdoor court for basketball games and tournaments.</div>
            <div class="facility-price">₱1000 / day</div>
            <div class="facility-availability available">Available: 7 AM - 9 PM</div>
            <button class="book-btn">Book Now</button>
        </div>

        <!-- Facility 4 -->
        <div class="facility-card" data-type="Hall">
            <img src="banket.jpg" alt="Facility Image" class="facility-image">
            <div class="facility-name">Banquet Hall</div>
            <div class="facility-type">Hall</div>
            <div class="facility-description">Spacious hall for weddings, parties, and large events.</div>
            <div class="facility-price">₱1500 / hour</div>
            <div class="facility-availability available">Available: 9 AM - 10 PM</div>
            <button class="book-btn">Book Now</button>
        </div>

        <!-- Facility 5 -->
        <div class="facility-card" data-type="Gym">
            <img src="gym.jpg" alt="Facility Image" class="facility-image">
            <div class="facility-name">Gymnasium</div>
            <div class="facility-type">Gym</div>
            <div class="facility-description">Indoor gymnasium for sports, fitness events, and exercise sessions.</div>
            <div class="facility-price">₱800 / hour</div>
            <div class="facility-availability unavailable">Unavailable</div>
            <button class="book-btn" disabled>Book Now</button>
        </div>
    </div>
        </div>
        </div>`;
   }
   // Search function
  function searchFacilities() {
            const searchInput = document.getElementById("facilitySearch").value.toLowerCase();
            const facilities = document.querySelectorAll(".facility-card");
            facilities.forEach(facility => {
                const facilityName = facility.querySelector(".facility-name").textContent.toLowerCase();
                if (facilityName.includes(searchInput)) {
                    facility.style.display = "block";
                } else {
                    facility.style.display = "none";
                }
            });
        }

        // Filter function
        function filterFacilities() {
            const filterValue = document.getElementById("facilityTypeFilter").value;
            const facilities = document.querySelectorAll(".facility-card");
            facilities.forEach(facility => {
                if (filterValue === "all" || facility.getAttribute("data-type") === filterValue) {
                    facility.style.display = "block";
                } else {
                    facility.style.display = "none";
                }
            });
        }
        

 // Function to module content
 function toggleSubmodules() {
        clearModuleContent(); // Clear previous module content

        const moduleContent = document.getElementById("module-content");
        moduleContent.innerHTML = `
        <p>Welcome to your module 1!</p>
        <div class="container mt-3">
            <div class="card">
                <div class="card-header">
                    <h4>module 1- Content Here</h4>
                </div>
                <div class="card-body">
                    <p>module 1 content is loaded here.</p>
                </div>
            </div>
        </div>`;
 }
 
  
 // Function to module content
 function loadSubmodule1() {
        clearModuleContent(); // Clear previous module content

        const moduleContent = document.getElementById("module-content");
        moduleContent.innerHTML = `
  <style>
        
        .container {
    display: flex;
    justify-content: space-between;
    max-width: 1100px;
    margin: 0 auto;
    gap: 20px;
    flex-wrap: wrap; /* Allow wrapping on small screens */
}
        /* Reservation Form Styling */
       .reservation-form {
    background-color: #ffffff; /* White background */
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    flex: 1; /* Take up available space */
    transition: box-shadow 0.3s;
    height: 580px; /* Set a fixed height */
    overflow-y: auto; /* Enable vertical scrolling */
}
.reservation-form:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.reservation-form h2 {
    color: #007BFF; /* Blue */
    margin-bottom: 20px;
    text-align: center;
    border-bottom: 2px solid #007BFF; /* Bottom border */
    padding-bottom: 10px;
}

        .form-group {
            display: flex; /* Use flexbox for side-by-side layout */
            flex-direction: column; /* Column for individual form elements */
            margin-bottom: 15px;
            flex: 1; /* Each group will take equal width */
            padding: 0 10px; /* Add padding for better spacing */
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold; /* Bold labels */
        }

        .form-group input, 
        .form-group select, 
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s;
        }

        .form-group input:focus, 
        .form-group select:focus, 
        .form-group textarea:focus {
            border-color: #007BFF; /* Blue */
            outline: none;
        }

        /* Adjustments for specific widths */
        .form-group.full-width {
            width: 100%;
        }

        button {
            background-color: #28a745; /* Green */
            color: white;
            border: none;
            padding: 10px 1px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
            font-weight: bold; /* Bold button text */
        }

        button:hover {
            background-color: #218838; /* Darker Green */
        }

        /* Side by Side Section */
      /* Info Section */
.info-section {
    background-color: #e9f7fa; /* Light Cyan */
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    flex: 1; /* Take up available space */
    transition: box-shadow 0.3s;
    height: 580px; /* Set a fixed height */
    overflow-y: auto; /* Enable vertical scrolling */
}

.info-section:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

        .info-section h2 {
            color: #007BFF; /* Blue */
            margin-bottom: 20px;
            text-align: center;
            border-bottom: 2px solid #007BFF; /* Bottom border */
            padding-bottom: 10px;
        }

        .info-section p {
            color: #333;
            margin-bottom: 10px;
            line-height: 1.5; /* Increased line height for readability */
        }

        .info-section ul {
            list-style-type: square;
            padding-left: 20px; /* Indentation for list */
            color: #333;
        }

        .info-section ul li {
            margin-bottom: 5px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* Stack elements vertically on smaller screens */
            }

            .reservation-form,
            .info-section {
                width: 100%; /* Take full width on mobile */
            }

            .form-group {
                width: 100%; /* Full width for form groups */
            }
        }

        /* New Layout for Side-by-Side Fields */
        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
        }
    </style>

 <div class="container">
        <!-- Reservation Form -->
        <div class="reservation-form">
            <h2>Reserve a Facility</h2>
            <form id="reservationForm" method="POST" action="submit_reservation.php">
                <div class="form-row">
                    <div class="form-group">
                        <label for="user_name">Name</label>
                        <input type="text" id="user_name" name="user_name" placeholder="Enter your name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="facility_name">Select Facility</label>
                        <select id="facility_name" name="facility_name" required>
                            <option value="" disabled selected>-- Select Facility --</option>
                            <option value="Community Hall">Community Hall</option>
                            <option value="Conference Room">Conference Room</option>
                            <option value="Basketball Court">Basketball Court</option>
                            <option value="Banquet Hall">Banquet Hall</option>
                            <option value="Gymnasium">Gymnasium</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="reservation_date">Reservation Date</label>
                        <input type="date" id="reservation_date" name="reservation_date" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="time" id="start_time" name="start_time" required>
                    </div>

                    <div class="form-group">
                        <label for="end_time">End Time</label>
                        <input type="time" id="end_time" name="end_time" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="additional_request">Additional Requests</label>
                        <textarea id="additional_request" name="additional_request" placeholder="Enter any additional requests" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="purpose">Purpose</label>
                        <input type="text" id="purpose" name="purpose" placeholder="Enter the purpose of reservation" required>
                    </div>
                </div>

                <button type="submit">Submit Reservation</button>
            </form>
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <h2>Facility Information</h2>
            <p>Ensure you have all the details ready for your reservation.</p>
            <ul>
                <li>Available facilities include:</li>
                <li>Community Hall</li>
                <li>Conference Room</li>
                <li>Basketball Court</li>
                <li>Banquet Hall</li>
                <li>Gymnasium</li>
            </ul>
            <p>Check our calendar for availability on the desired date.</p>
            <p>For any inquiries, please contact our office.</p>
            <p>63+ 919 659 5120</p>
        </div>
    </div>
        </div>`;
 }
          // Function to load Module 1 content
       // Function to load Module 1 content
       function loadSubmodule3() {
    clearModuleContent(); // Clear previous module content
    const moduleContent = document.getElementById("module-content");
    moduleContent.innerHTML = `
 
</div>
    `;
}

function loadSubmodule2() {
    clearModuleContent(); // Clear previous module content

    const moduleContent = document.getElementById("module-content");
    moduleContent.innerHTML = `
    <style>

.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

header {
    text-align: center;
    margin-bottom: 20px;
}

.calendar-container {
    position: relative;
}

.navigation {
    margin-bottom: 10px;
    text-align: center;
}

button {
    padding: 10px 15px;
    margin: 0 5px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

#calendar {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 10px;
}

.day {
    padding: 15px;
    text-align: center;
    border-radius: 5px;
    cursor: pointer;
}

.day-label {
    background-color: #e9ecef;
}

.green {
    background-color: #28a745;
    color: white;
}

.yellow {
    background-color: #ffc107;
    color: black;
}

.red {
    background-color: #dc3545;
    color: white;
}

.gray {
    background-color: #6c757d;
    color: white;
}

.event {
    margin-top: 5px;
    font-size: 0.8em;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 8px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>
    <div class="container">
            <header>
                <h1>Barangay Facility Management Dashboard</h1>
            </header>
            <div class="calendar-container">
                <h2>Facility Availability Calendar</h2>
                <div class="navigation">
                    <button id="prevMonth">Previous</button>
                    <button id="nextMonth">Next</button>
                </div>
                <div id="calendar"></div>
            </div>
        </div>

        <!-- Modal for Event Details -->
        <div id="eventModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 id="modalTitle"></h2>
                <form id="eventForm">
                    <input type="hidden" id="eventDate" />
                    <label for="eventStatus">Status:</label>
                    <select id="eventStatus">
                        <option value="available">Available</option>
                        <option value="pending">Pending</option>
                        <option value="unavailable">Unavailable</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                    <button id="saveEvent">Save</button>
                    <button id="deleteEvent" style="display:none;">Delete</button>
                </form>
            </div>
        </div>
    `;

    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    const events = []; // Store events as objects with date and status

    const calendar = document.getElementById("calendar");
    const eventModal = document.getElementById("eventModal");
    const modalTitle = document.getElementById("modalTitle");
    const eventForm = document.getElementById("eventForm");
    const eventDateInput = document.getElementById("eventDate");
    const eventStatusSelect = document.getElementById("eventStatus");
    const saveEventButton = document.getElementById("saveEvent");
    const deleteEventButton = document.getElementById("deleteEvent");

    // Function to close the modal
    const closeModal = () => {
        eventModal.style.display = "none";
        eventForm.reset(); // Reset the form
        deleteEventButton.style.display = "none"; // Hide delete button
    };

    // Function to open modal with event details
    const openModal = (date, status) => {
        eventDateInput.value = date; // Set the date in the hidden input
        eventStatusSelect.value = status; // Set the status in the select
        modalTitle.textContent = `Event on ${date}`;
        deleteEventButton.style.display = status ? "block" : "none"; // Show delete button if event exists
        eventModal.style.display = "block"; // Show the modal
    };

    // Function to create calendar days
    const createCalendar = () => {
        calendar.innerHTML = ''; // Clear previous calendar days
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

        for (let i = 1; i <= daysInMonth; i++) {
            const date = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            const dayDiv = document.createElement("div");
            dayDiv.classList.add("day");
            dayDiv.classList.add("day-label");
            dayDiv.textContent = i;

            const event = events.find(event => event.date === date);
            if (event) {
                switch (event.status) {
                    case 'available':
                        dayDiv.classList.add("green");
                        dayDiv.innerHTML += `<div class="event">Available</div>`;
                        break;
                    case 'pending':
                        dayDiv.classList.add("yellow");
                        dayDiv.innerHTML += `<div class="event">Pending</div>`;
                        break;
                    case 'unavailable':
                        dayDiv.classList.add("red");
                        dayDiv.innerHTML += `<div class="event">Unavailable</div>`;
                        break;
                    case 'maintenance':
                        dayDiv.classList.add("gray");
                        dayDiv.innerHTML += `<div class="event">Maintenance</div>`;
                        break;
                }
            } else {
                dayDiv.classList.add("green"); // Default to available if no event
                dayDiv.innerHTML += `<div class="event">Available</div>`;
            }

            // Add click event to open modal
            dayDiv.addEventListener("click", () => {
                openModal(date, event ? event.status : null);
            });

            calendar.appendChild(dayDiv);
        }
    };
    
    // Save event details to the array
    saveEventButton.addEventListener("click", (e) => {
        e.preventDefault(); // Prevent form submission
        const date = eventDateInput.value;
        const status = eventStatusSelect.value;

        // Check if event already exists and update or add
        const existingEventIndex = events.findIndex(event => event.date === date);
        if (existingEventIndex >= 0) {
            events[existingEventIndex].status = status; // Update existing event
        } else {
            events.push({ date, status }); // Add new event
        }

        closeModal(); // Close the modal and refresh the calendar
        createCalendar(); // Recreate the calendar to reflect changes
    });

    // Delete event from the array
    deleteEventButton.addEventListener("click", () => {
        const date = eventDateInput.value;
        const existingEventIndex = events.findIndex(event => event.date === date);
        if (existingEventIndex >= 0) {
            events.splice(existingEventIndex, 1); // Remove event
        }

        closeModal(); // Close the modal and refresh the calendar
        createCalendar(); // Recreate the calendar to reflect changes
    });

    // Close the modal on clicking the close button
    document.querySelector(".close").onclick = closeModal;

    // Navigate to previous month
    document.getElementById("prevMonth").onclick = () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        createCalendar();
    };

    // Navigate to next month
    document.getElementById("nextMonth").onclick = () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        createCalendar();
    };

    // Initial calendar creation
    createCalendar();
}



          // Function to load Module 1 content
       // Function to load Module 1 content
function Module3() {
    clearModuleContent(); // Clear previous module content
    const moduleContent = document.getElementById("module-content");
    moduleContent.innerHTML = `
 
</div>
    `;
}
   


</script>





<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <!-- Logo for LGU -->
    <img id="lgu-logo" src="logo.png" alt="LGU Logo" class="lgu-logo">
 
        <ul class="sidebar-menu">
        </li>
        <li class="list-group-item">
            <a href="#" onclick="dashboard()"><i class="fas fa-th-large"></i>Dashboard</a></li>
            <ul class="list-group">

            <li class="list-group-item">
                    <a href="#" onclick="loadModule1()"><i class="fas fa-wrench"></i>FACILITY LISTING</a>
                </li>
                

         <!-- Dropdown for Module 1 -->
    <li class="list-group-item">
        <a href="#" id="module2" onclick="toggleSubmodules('submodule1-dropdown')">
            <i class="fas fa-wrench"></i>Module 2 <i class="fas fa-chevron-down"></i>
        </a>
        <ul class="submodule-dropdown" id="submodule1-dropdown" style="display: none;">
            <li><a href="#" id="submodule1" onclick="loadSubmodule1()">FACILITY RESERVATIONS</a></li>
            <li><a href="#" id="submodule2" onclick="loadSubmodule2()">Submodule 2</a></li>
            <li><a href="#" id="submodule3" onclick="loadSubmodule3()">Submodule 3</a></li>
        </ul>
    </li>


    <li class="list-group-item">
            <a href="#" onclick="module3()"><i class="fas fa-wrench"></i>module 3</a></li>
            <ul class="list-group">
    </li>
                
                </li>
                </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <header>
            <div class="menu-toggle" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <div class="header-right">
                <i class="fas fa-comment-dots" id="message-icon"></i>
                <i class="fas fa-bell" id="notification-icon"></i>
                <div class="profile" id="profile-icon">

                    <div class="profile-container">
                        <div class="profile-icon">

<!-- User Profile Icon and Dropdown -->
<div class="user-profile" onclick="toggleDropdown()">
    <img src="wa.jpg" alt="Profile" class="profile-image">
</div>

<!-- Dropdown Menu -->
<div class="dropdown-menu" id="dropdownMenu">
    <div class="dropdown-header">
        <img src="aa.jpg" alt="User Avatar">
        <h3>Hello, User!</h3>
    </div>
    <ul>
        <li>
            <a href="edit_profile.php">
                <i class="fas fa-user icon-profile"></i><span>Edit Profile</span>
                <i class="fas fa-chevron-right arrow-icon"></i>
            </a>
        </li>
        <li>
            <i class="fas fa-cog icon-settings"></i><span>Settings & Privacy</span>
            <i class="fas fa-chevron-right arrow-icon"></i>
        </li>
        <li>
            <i class="fas fa-question-circle icon-help"></i><span>Help & Support</span>
            <i class="fas fa-chevron-right arrow-icon"></i>
        </li>
        <li>
            <i class="fas fa-sign-out-alt icon-logout"></i><a href="logout.php">Logout</a>
            <i class="fas fa-chevron-right arrow-icon"></i>
        </li>
    </ul>
</div>



                  
                </div>
            </div>
        </header>
        <main>
            <h1 id="content-title">Dashboard</h1>
            
        
            <!-- Empty Section for Module Content -->
           <!-- Content Area -->
    <div class="col-9">
        <div id="module-content" class="content-area"></div>
    </div>

        </main>
    </div>

    
    <script>// Toggle sidebar functionality
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("main-content").classList.toggle("collapsed");
        });
   
        // Change content based on clicked module
        document.querySelectorAll(".sidebar-menu li a").forEach(item => {
            item.addEventListener("click", function (event) {
                // Remove active class from all menu items
                document.querySelectorAll(".sidebar-menu li").forEach(li => li.classList.remove("active"));
                
                // Add active class to clicked menu item
                event.currentTarget.parentElement.classList.add("active");
        
                // Change the content dynamically
                const contentTitle = document.getElementById("content-title");
                contentTitle.textContent = event.currentTarget.textContent.trim();
            });
        });
        
        // Handle profile, notifications, and messages click
        document.getElementById("profile-icon").addEventListener("click", function () {
            const profileIcon = document.getElementById('profileIcon');
const dropdownMenu = document.getElementById('dropdownMenu');

// Toggle the dropdown menu when the profile icon is clicked
profileIcon.addEventListener('click', function() {
  dropdownMenu.classList.toggle('show');
});

// Close the dropdown menu if clicked outside
window.addEventListener('click', function(e) {
  if (!profileIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
    dropdownMenu.classList.remove('show');
  }
});
        });

   // Function to toggle dropdown menu
   function toggleDropdown() {
        var dropdown = document.getElementById("dropdownMenu");
        dropdown.classList.toggle("active");
    }

    // Close the dropdown if clicked outside
    window.onclick = function(event) {
        if (!event.target.closest('.user-profile')) {
            document.getElementById("dropdownMenu").classList.remove("active");
        }
    }
        
        document.getElementById("notification-icon").addEventListener("click", function () {
            alert("Notifications clicked!");
        });
        
        document.getElementById("message-icon").addEventListener("click", function () {
            alert("Messages clicked!");
        });

// Function to toggle the dropdown visibility
function toggleSubmodules(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    if (dropdown.style.display === "none" || dropdown.style.display === "") {
        dropdown.style.display = "block";
    } else {
        dropdown.style.display = "none";
    }
}

// Function to load the specific submodule
function loadSubmodule(submoduleNumber) {
    clearModuleContent(); // Clear previous module content
    const moduleContent = document.getElementById("module-content");

    let submoduleTitle = "";
    let submoduleContent = "";

    switch (submoduleNumber) {
        case 1:
            submoduleTitle = "Submodule 1";
            submoduleContent = "Content for Submodule 1 is loaded here.";
            break;
        case 2:
            submoduleTitle = "Submodule 2";
            submoduleContent = "Content for Submodule 2 is loaded here.";
            break;
        case 3:
            submoduleTitle = "Submodule 3";
            submoduleContent = "Content for Submodule 3 is loaded here.";
            break;
        default:
            submoduleTitle = "Module 1";
            submoduleContent = "Default content for Module 1.";
    }

    moduleContent.innerHTML = `
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4>${submoduleTitle}</h4>
            </div>
            <div class="card-body">
                <p>${submoduleContent}</p>
            </div>
        </div>
    </div>`;
}

// Function to clear previous module content
function clearModuleContent() {
    document.getElementById("module-content").innerHTML = "";
}

    
</script>

</body>
</html>