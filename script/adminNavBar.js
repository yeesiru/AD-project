function showSideBar() {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.style.display = 'flex';
    } else {
        console.error("Sidebar element not found.");
    }
}

function hideSidebar() {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.style.display = 'none';
    } else {
        console.error("Sidebar element not found.");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const navbarHTML = `
        <div class="top">
            <div class="container">
                <div class="logo">
                    <img src="../img/SJAM-logo.png" alt="SJAM Logo" />
                    <p>SJAM Connect</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation bar -->
        <nav>
            <ul class="sidebar">
                <li onclick="hideSidebar()">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black">
                            <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                        </svg>
                    </a>
                </li>
                <li><a href="../mainPage/adminHomepage.html">Home</a></li>
                <li><a href="../User/ownProfile.php">Profile</a></li>
                <li><a class="sub-btn">Manage &#x25BE;</a>
                    <ul class="sidebar-dropdown">
                        <li><a href="../Hall/viewHallList.php" class="sub-item">Hall</a></li>
                        <li><a href="../ambulance/viewAmbulance.php" class="sub-item">Ambulance</a></li>
                        <li><a class="sub-btn">Ambulance &#x25BE;</a>
                            <ul class="sidebar-dropdown">
                                <li><a href="../ambulance/viewAmbulance.php" class="sub-item">Manage Ambulance</a></li>
                                <li><a href="../ambulance/viewAmbulanceBooking.php" class="sub-item">Manage Ambulance Booking</a></li>
                            </ul>
                        </li>
                        <li><a href="../Equipment/equipmmentList.php" class="sub-item">Equipment</a></li>
                    </ul>
                </li>
                <li><a href="../Feedback/admin_viewfeedback.php">Feedback</a></li>
                <li><a href="../User/userManage.php">User List</a></li>
                <li><a href="../mainPage/logout.php">Logout</a></li>
            </ul>

        <ul>
            <li class="hideOnMobile"> <a href="../mainPage/adminHomepage.html">Home</a></li>
            <li class="hideOnMobile"> <a href="../User/ownProfile.php">Profile</a></li>
            <li class="hideOnMobile"  style="width: 149px;"> <a href="#">Manage &#x25BE;</a>
                <ul class="dropdown">
                    <li><a href="../Hall/viewHallList.php">Hall</a></li>
                    <li><a href="../ambulance/viewAmbulance.php">Ambulance</a></li>
                    <li><a href="../Equipment/equipmmentList.php">Equipment</a></li>
                </ul>
            </li>
            <li class="hideOnMobile"> <a href="../Feedback/admin_viewfeedback.php">Feedback</a></li>
            <li class="hideOnMobile"> <a href="../User/userManage.php">User List</a></li>
            <li class="hideOnMobile" style="text-align: right;"> <a href="../mainPage/logout.php">Logout</a></li>
            <li class="menuButton" onclick=showSideBar()> <a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                        height="24px" viewBox="0 -960 960 960" width="24px" fill="black">
                        <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                    </svg></a></li>
        </ul>
    </nav>
    `;

    // Insert the navbar into the DOM
    const navbar = document.getElementById('navbar');
    if (navbar) {
        navbar.innerHTML = navbarHTML;

        // Query and add event listeners after the HTML is inserted
        const subBtn = document.querySelector('.sub-btn');
        const dropdown = document.querySelector('.sidebar-dropdown');

        if (subBtn && dropdown) {
            subBtn.addEventListener('click', () => {
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });
        } else {
            console.error("Sub-btn or sidebar-dropdown not found.");
        }
    } else {
        console.error("Navbar container not found.");
    }
});
