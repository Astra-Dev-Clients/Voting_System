<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zetech online voting</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Assets/CSS/styles.css">
    <!-- Boostrap CSS -->
    <!-- Stylesheet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="./Assets/dist/css/bootstrap.min.css">

     <!-- include font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">
<!-- Header -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center justify-content-center" href="#"> <img src="Assets/Img/logo11.png" alt="" class="img-fluid me-2" style="width: 39px; height: auto;"> <div class="d-flex flex-column">Church of God <br><small style="font-size: x-small;">7th Day New Jerusalem</small></div> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto ms-auto my-2 my-lg-0 gap-4 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Sermons</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Missions
                         </a>
                         <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Burundi</a></li>
                            <li><a class="dropdown-item" href="#">Congo</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Tanzania</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                </ul>
                <a href="./auth/index.php" class="btn text-white" style="background-color: #1C1D3C;">Get Started</a>
            </div>
        </div>
    </nav>
 
    <!-- Hero Section -->
    <div class="container-fluid hero position-relative" style="background: rgb(255,255,255);
      background: linear-gradient(73deg, rgba(255,255,255,1) 8%, rgba(28, 29, 60, 0.207));">
      <div class="overlay"></div>


        <div class="container px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center justify-content-center g-2 py-5">
                <div id="carouselExampleIndicators" class="carousel slide col-10 col-sm-8 col-lg-6" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="Assets/Img/Helping.jpg" class="d-block mx-lg-auto img-fluid" style="scale: 70%; border-radius: 2rem 0 2rem;" alt="Helping" loading="lazy">
                        </div>
                        <div class="carousel-item">
                            <img src="Assets/Img/Mission/Picture 023.jpg" class="d-block mx-lg-auto img-fluid" style="scale: 70%; border-radius: 2rem 0 2rem;" alt="Cross" loading="lazy">
                        </div>
                        <div class="carousel-item">
                            <img src="Assets/Img/baptism.jpg" class="d-block mx-lg-auto img-fluid" style="scale: 70%; border-radius: 2rem 0 2rem;" alt="Baptism" loading="lazy">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold text-body-emphasis lh-2 mb-3">Bringing Light to the World</h1>
                    <p class="lead">Join us in worship and experience God's love. Our mission is to bring hope, faith, and community to everyone. </p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a type="button" class="btn text-white btn-lg px-4 me-md-2" style="background-color: #1C1D3C;" href="#">Church Near You</a>
                        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Learn More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- add image overlay to hero section between back and the contnet -->
      <style>
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:url(Assets/Img/Mission/baptism.jpg);
            background-position: center;
            background-size: cover;
            background-blend-mode: overlay;
            opacity: 0.5;
            z-index: -1;
        }
      </style>



    <!-- footer -->
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Sermons</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Library</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Blog</a></li>
        </ul>
        <p class="text-center text-muted">© 2025 All rights reserved</p>
    </footer>


    <!-- Boostrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- <script src="./assets/dist/js/bootstrap.bundle.min.js"></script> -->

</body>

</html>