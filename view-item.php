<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View-item</title>
    <script src="https://kit.fontawesome.com/b7f786ff51.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>

    <section>
        <div class="sidenav">
            <h1 class="logo"><a href="index.html"><i class="fa-solid fa-bucket"></i>LifeLux</a></h1>
            <h2 class="heading">My Lists</h2>
            <ul>
                <li><a href="view-item.html"><i class="fa-solid fa-location-dot"></i>Travel Adventures</a></li>
                <li><a href="#"><i class="fa-solid fa-arrow-up-right-dots"></i>Personal growth and development</a></li>
                <li><a href="#"><i class="fa-solid fa-star"></i>Creative pursuits</a></li>
            </ul>
            <div class="six">
                <a href="add-list.html">Create a new List</a>
            </div>

            <nav>
                <h2 class="heading">Explore</h2>
                <ul>
                    <li><a href="Search.html"><i class="fa-solid fa-search"></i>Search</a></li>
                    <li><a href="list.html"><i class="fa-brands fa-wpexplorer"></i>Explore public lists</a></li>
                    <li><a href="Search.html"><i class="fa-solid fa-shuffle"></i>Random list entry</a></li>
                </ul>

            </nav>

            <div class="user">
                <h3><a href="#"><i class="fa-solid fa-user"></i>Jane Smith</a></h3>
                <div class="profile">
                    <ul>
                        <li><a href="#"><i class="fa-regular fa-pen-to-square"></i>Edit Profile</a></li>
                        <li><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>Sign Out</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

        <div class="content">
            <!--Bucket List Entry-->

            <div class="top">
                <ul>
                    <li class="grey"><a href="index.html">My Lists</a></li>
                    <li><i class="fa-solid fa-greater-than"></i></li>
                    <li class="light"><a href="">Travel Adventures</a></li>
                    <li><i class="fa-solid fa-greater-than"></i></li>
                    <li class="dark"><a href="">Explore Europe</a></li>
                </ul>
            </div>

            <h2 class="login" id="view-content"><strong>Explore Europe</strong></h2>
            <div class="buttons">
                <a href="edit-item.html"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                <a href="#"><i class="fa-solid fa-trash"></i>Delete</a>
                <p>Completion date: ____</p>
                <p>Started on: September 2018</p>
            </div>


            <ul>

            </ul>

            <p class="indent">
                Exploring Europe has been a lifelong dream of mine,
                and I can't wait to immerse myself in the rich history,
                diverse cultures, and breathtaking landscapes the continent
                has to offer. My European adventure will be a journey of discovery,
                where I hope to:
            </p>

            <p class="head1"><strong>Wander through the Historic Streets of Rome</strong></p>
            <p class="indent">
                Walking through the historic streets of Rome was like stepping into a time machine.
                The city is a living testament to millennia of history. As you stroll through the ancient
                Roman Forum, you can almost hear the echoes of past emperors and citizens. The Colosseum,
                with its grandeur and grand history, leaves you in awe. And when you toss a coin into the Trevi
                Fountain, you're not only making a wish but also becoming a part of a tradition that spans centuries.
                The Italian cuisine is a delightful adventure on its own, from savoring the perfect pasta to enjoying
                authentic gelato. Exploring Rome feels like being part of an epic story
            </p>

            <div class="image-container">
                <img src="img/rome.jpg" alt="an image of rome" class="rounded-image" height="300" width="480">
                <p class="caption">A beautiful view of Rome</p>
            </div>


            <p class="head1"><strong>Witness the Northern Lights in Scandinavia</strong></p>
            <p class="indent">
                Witnessing the Northern Lights in Scandinavia:
                Standing under the shimmering Northern Lights in Scandinavia is an
                otherworldly experience. The dancing colors across the Arctic sky are nothing
                short of magical. It's a moment when you feel incredibly connected to nature
                and the universe. I remember the stillness of the night, the crisp cold air,
                and the excitement of waiting for the lights to appear. When they do, it's as
                if the heavens are putting on a show just for you. The sheer beauty and unpredictability
                of the Northern Lights are a humbling reminder of the wonders of our planet.
            </p>
            <div class="image-container">
                <img src="img/aurora.jpg" alt="an image of rome" class="rounded-image" height="300" width="480">
                <p class="caption">The Northern Lights</p>
            </div>



            <footer>
                <p>&copy; 2023 - David Awodumila</p>
            </footer>
        </div>
</body>

</html>