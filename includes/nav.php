<section>
        <div class="sidenav">
            <h1 class="logo"><a href="index.php"><i class="fa-solid fa-bucket"></i>LifeLux</a></h1>
            <h2 class="heading">My Lists</h2>
            <ul>
                <li><a href="view-item.php"><i class="fa-solid fa-location-dot"></i>Travel Adventures</a></li>
                <li><a href="#"><i class="fa-solid fa-arrow-up-right-dots"></i>Personal growth and development</a></li>
                <li><a href="#"><i class="fa-solid fa-star"></i>Creative pursuits</a></li>
            </ul>
            <div class="six">
                <a href="add-entry.php">Create a new entry</a>
            </div>

            <nav>
                <h2 class="heading">Explore</h2>
                <ul>
                    <li><a href="Search.php"><i class="fa-solid fa-search"></i>Search</a></li>
                    <li><a href="list.php"><i class="fa-brands fa-wpexplorer"></i>Explore public lists</a></li>
                    <li><a href="Search.php"><i class="fa-solid fa-shuffle"></i>Random list entry</a></li>
                </ul>

            </nav>

            <div class="user">
                <h3><a href=""><i class="fa-solid fa-user"></i><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?></a></h3>
                <div class="profile">
                    <ul>
                        <li><a href="edit-account.php"><i class="fa-regular fa-pen-to-square"></i>Edit Profile</a></li>
                        <li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Sign Out</a></li>
                    </ul>
                </div>
            </div>

        </div>

    </section>