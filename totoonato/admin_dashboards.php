<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin_logins.php"); // Redirect to login page if not logged in
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
    <link rel="stylesheet" href="admin_dashboards.css">
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
        .header .left h2 {
            color: #34495e;
            font-size: 32px;
            font-weight: 600;
        }

        .header .left p {
            color: #7f8c8d;
            font-size: 18px;
        }

        .search-bar {
            position: relative;
            display: inline-block;
        }

        .search-bar input {
            padding: 15px 10px;
            border: none;
            border-radius: 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-bar i {
            position: absolute;
            right: 26px;
            top: 45%;
            transform: translateY(-50%);
            color: #7f8c8d;
        }

        .user-profile {
            display: flex;
            align-items: center;
            font-size: 18px;
        }

        .user-profile i {
            font-size: 40px;
            margin-left: 10px;
            color: #3498db;
        }

        /* Dashboard cards (Dashboard Overview) */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px; /* Apply the same gap as Facility Reports */
        }

        .card {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            cursor: pointer; /* Pointer cursor for clickable cards */
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 22px;
            font-weight: 600;
        }

        .card .icon {
            font-size: 50px;
            color: #3498db;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 18px;
            font-weight: 500;
            color: #555;
        }

        /* Badges for statuses */
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 14px;
            color: #fff;
            margin-left: 10px;
        }

        .badge.pending {
            background-color: #f39c12;
        }

        .badge.new {
            background-color: #2ecc71;
        }

        /* Progress bar styles */
        .progress-bar {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 25px;
            margin-top: 10px;
        }

        .progress {
            height: 10px;
            background-color: #3498db;
            border-radius: 25px;
        }

        /* Reports Section */
        .reports-section {
            margin-top: 40px;
        }

        .reports-section h3 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 26px;
            font-weight: 600;
        }

        .reports-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px; /* Same gap as Dashboard Overview */
        }

        .report-card {
            background-color: #f9f9f9;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: background-color 0.3s ease, transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .report-card:hover {
            background-color: #3498db;
            color: white;
            transform: translateY(-10px);
        }

        .report-card h4 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .report-card p {
            font-size: 18px;
            font-weight: 500;
        }

        /* User Notifications Section */
        .notifications {
            margin-top: 20px;
            padding: 15px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .notifications h4 {
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .notification-item {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 16px;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .dashboard-cards {
                grid-template-columns: 1fr 1fr;
            }

            .reports-cards {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <div class="main-content">
        <div class="header">
            <div class="left">
                
                <p id="current-time"></p> <!-- For displaying date and time -->
            </div>
            <div class="right">
                <div class="search-bar">
                    <input type="text" placeholder="Search facilities...">
                    <i class="fas fa-search"></i>
                </div>
                <div class="user-profile">
                   
                </div>
            </div>
        </div>

        <div class="dashboard-cards">
            <div class="card">
                <div class="icon"><i class="fas fa-users"></i></div>
                <h3>Total Residents</h3>
                <p>1,200</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-building"></i></div>
                <h3>Available Facilities</h3>
                <p>6</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-file-alt"></i></div>
                <h3>Recent Reports</h3>
                <p>15 <span class="badge pending">Pending</span></p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-bell"></i></div>
                <h3>Notifications</h3>
                <p>5 <span class="badge new">New</span></p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                <h3>Upcoming Events</h3>
                <p>3</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-chart-line"></i></div>
                <h3>Usage Trends</h3>
                <p>See Graphs</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-cogs"></i></div>
                <h3>Maintenance Due</h3>
                <p>2 Facilities</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-comments"></i></div>
                <h3>User Feedback</h3>
                <p>4 New</p>
            </div>
        </div>

            </div>
        </div>
        </div>`;
 }
 // Display current date and time
 function updateTime() {
            const now = new Date();
            document.getElementById('current-time').innerText = now.toLocaleString();
        }
        setInterval(updateTime, 1000);







 // Function to load Module 2 content
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

</div>


        <!-- Facility 2 -->
        <div class="facility-card" data-type="Room">
            <img src="confe.jpg" alt="Facility Image" class="facility-image">
            <div class="facility-name">Conference Room</div>
            <div class="facility-type">Room</div>
            <div class="facility-description">Ideal for small meetings, presentations, and work sessions.</div>
            <div class="facility-price">₱300 / hour</div>
            <div class="facility-availability unavailable">Unavailable</div>
      
        </div>

        <!-- Facility 3 -->
        <div class="facility-card" data-type="Outdoor Court">
            <img src="kort.jpg" alt="Facility Image" class="facility-image">
            <div class="facility-name">Basketball Court</div>
            <div class="facility-type">Outdoor Court</div>
            <div class="facility-description">Outdoor court for basketball games and tournaments.</div>
            <div class="facility-price">₱1000 / day</div>
            <div class="facility-availability available">Available: 7 AM - 9 PM</div>
         
        </div>

        <!-- Facility 4 -->
        <div class="facility-card" data-type="Hall">
            <img src="banket.jpg" alt="Facility Image" class="facility-image">
            <div class="facility-name">Banquet Hall</div>
            <div class="facility-type">Hall</div>
            <div class="facility-description">Spacious hall for weddings, parties, and large events.</div>
            <div class="facility-price">₱1500 / hour</div>
            <div class="facility-availability available">Available: 9 AM - 10 PM</div>
          
        </div>

        <!-- Facility 5 -->
        <div class="facility-card" data-type="Gym">
            <img src="gym.jpg" alt="Facility Image" class="facility-image">
            <div class="facility-name">Gymnasium</div>
            <div class="facility-type">Gym</div>
            <div class="facility-description">Indoor gymnasium for sports, fitness events, and exercise sessions.</div>
            <div class="facility-price">₱800 / hour</div>
            <div class="facility-availability unavailable">Unavailable</div>
       
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
    moduleContent.innerHTML = `<?php
        // Admin dashboard to view and manage reservations
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "facility_reservation";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Initialize search variable
        $search = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['search'])) {
            $search = $conn->real_escape_string($_POST['search']);
            $sql = "SELECT * FROM reservations WHERE user_name LIKE '%$search%' OR facility_name LIKE '%$search%'";
        } else {
            $sql = "SELECT * FROM reservations";
        }

        $result = $conn->query($sql);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin Dashboard</title>
        <style>
   /* Main Dashboard Layout */
.dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Responsive grid */
    gap: 20px; /* Space between cards */
    margin-top: 20px; /* Spacing above the cards */
}

/* Reservation Card Styling */
.card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    overflow: hidden; /* Keep the content contained */
    transition: transform 0.2s; /* For hover effect */
}

.card:hover {
    transform: scale(1.02); /* Slightly enlarge on hover */
}

/* Image Styling (if applicable) */
.facility-image {
    width: 100%; /* Full width image */
    height: auto; /* Maintain aspect ratio */
}

/* Card Content Styling */
.card-content {
    padding: 20px; /* Padding inside the card */
}

/* Specific Details Styling */
.card-content .detail {
    margin-bottom: 15px; /* Space between each detail */
    font-size: 16px; /* Font size for details */
    color: #333; /* Text color */
}

/* Labels for details */
.card-content .detail-label {
    font-weight: bold;
    color: #17252a; /* Dark color for labels */
    display: inline-block;
    width: 130px; /* Fixed width to align with values */
}

/* Values for details */
.card-content .detail-value {
    color: #3aafa9; /* Greenish color for values */
    font-weight: 600;
    display: inline-block;
}

/* Status Indicator */
.card-content .status {
    margin-top: 10px;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 14px;
    display: inline-block;
}

.status.approved {
    background-color: #28a745;
    color: white;
}

.status.pending {
    background-color: #ffc107;
    color: white;
}

.status.rejected {
    background-color: #dc3545;
    color: white;
}

/* Buttons for Actions */
.actions {
    margin-top: 10px; /* Spacing above actions */
}

.approve-btn, .reject-btn {
    padding: 10px 15px; /* Padding for buttons */
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s; /* Smooth background color transition */
}

.approve-btn {
    background-color: #28a745; /* Green */
}

.approve-btn:hover {
    background-color: #218838; /* Darker green on hover */
}

.reject-btn {
    background-color: #dc3545; /* Red */
}

.reject-btn:hover {
    background-color: #c82333; /* Darker red on hover */
}

/* Scrollable Container */
.scrollable-container {
    overflow-y: auto; /* Enable scrolling if content overflows */
    max-height: 600px; /* Limit height */
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard {
        grid-template-columns: 1fr; /* Stack cards on smaller screens */
    }

    .card {
        margin-bottom: 20px; /* Space below cards */
    }
}

</style>
        </head>
        <body>
        
        <div class="form-group">
            <h2>Admin Dashboard</h2>
            <div class="search-container">
                <form method="POST" action="">
                    <input type="text" name="search" placeholder="Search by name or facility..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit">Search</button>
                </form>
            </div>
            <?php
            // Check for success message
            if (isset($_GET['message']) && $_GET['message'] == 'deleted_successfully') {
                echo '<div style="color: green; text-align: center; margin-bottom: 20px;">Reservation deleted successfully!</div>';
            }
            ?>
            <div class="scrollable-container">
                <div class="dashboard">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="card">
                                <img src="path_to_image.jpg" alt="<?php echo $row['facility_name']; ?>">
                                <div class="card-content">
                                    <h2><?php echo $row['facility_name']; ?></h2>
                                    <p class="facility">Facility: <?php echo $row['facility_name']; ?></p>
                                    <p>Reserved by: <?php echo $row['user_name']; ?></p>
                                    <p>Email: <?php echo $row['email']; ?></p>
                                    <p>Date: <?php echo $row['reservation_date']; ?></p>
                                    <p>Time: <?php echo $row['start_time']; ?> - <?php echo $row['end_time']; ?></p>
                                    <p>Additional Request: <?php echo $row['additional_request']; ?></p>
                                    <p>Purpose: <?php echo $row['purpose']; ?></p>
                                    <p class="status">Status: <?php echo $row['status']; ?></p>
                                   <div class="actions">
    <button class="approve-btn" onclick="updateReservationStatus(<?php echo $row['id']; ?>, 'approve')">Approve</button>
    <button class="reject-btn" onclick="updateReservationStatus(<?php echo $row['id']; ?>, 'reject')">Reject</button>
</div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No reservations found.";
                    }
                    ?>
                </div>
            </div>
        </div>

        </div>`;
 }
 function updateReservationStatus(id, action) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_reservation.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
                alert(response.message); // Notify success
                location.reload(); // Reload the page to see updated status
            } else {
                alert(response.message); // Notify error
            }
        }
    };
    xhr.send(`id=${id}&action=${action}`);
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


 
function loadSubmodule3() {
    clearModuleContent(); // Clear previous module content

    const moduleContent = document.getElementById("module-content");
    moduleContent.innerHTML = `

    `;
}


       function modules3() {
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
            <i class="fas fa-wrench"></i>FACILITY <i class="fas fa-chevron-down"></i>
        </a>
        <ul class="submodule-dropdown" id="submodule1-dropdown" style="display: none;">
            <li><a href="#" id="submodule1" onclick="loadSubmodule1()">FACILITY RESERVATIONS</a></li>
            <li><a href="#" id="submodule2" onclick="loadSubmodule2()">FACILITY AVAILABILITY</a></li>
            <li><a href="#" id="submodule3" onclick="loadSubmodule3()">Submodule 3</a></li>
        </ul>
    </li>


    <li class="list-group-item">
            <a href="#" onclick="modules3()"><i class="fas fa-wrench"></i>CHART</a></li>
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
        <h3>Hello, Admin!</h3>
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