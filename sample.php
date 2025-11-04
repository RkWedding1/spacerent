<?php
// SpaceRent homepage with Bootstrap 5 in PHP
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SpaceRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, sans-serif;
        }

        .hero-bg {
            background: linear-gradient(135deg, #2563eb, #7c3aed, #db2777);
            min-height: 100vh;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 2px 2px, rgba(255, 255, 255, 0.1) 1px, transparent 0);
            background-size: 40px 40px;
            opacity: 0.1;
            pointer-events: none;
            z-index: 0;
        }

        .search-input {
            background-color: #f8fafc;
            border-radius: 1rem;
            border: none;
            padding: 0.75rem 1rem;
        }

        .search-container {
            background-color: #f8fafc;
            border-radius: 2rem;
            box-shadow: 0 10px 20px rgb(0 0 0 / 0.2);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .stats-label {
            opacity: 0.8;
        }

        .feature-card {
            background: linear-gradient(to bottom right, #f9fafb, #ffffff);
            border: 1px solid #f3f4f6;
            border-radius: 1rem;
            transition: box-shadow 0.3s ease;
        }

        .feature-card:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .icon-bg {
            width: 48px;
            height: 48px;
            border-radius: 1rem;
            background: linear-gradient(to bottom right, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: white;
        }

        .icon-bg svg {
            width: 24px;
            height: 24px;
        }

        .category-card {
            border-radius: 1rem;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 1px 4px rgb(0 0 0 / 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            position: relative;
        }

        .category-card:hover {
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.2);
            transform: scale(1.03);
        }

        .category-image {
            width: 100%;
            aspect-ratio: 4 / 5;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-image {
            transform: scale(1.1);
        }

        .category-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.15), transparent);
            pointer-events: none;
        }

        footer {
            background-color: #111827;
            color: #9ca3af;
        }

        footer a {
            color: #9ca3af;
            text-decoration: none;
        }

        footer a:hover {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-bg d-flex flex-column justify-content-center text-center px-4"
        style="padding-top: 5rem; padding-bottom: 8rem; position: relative;">
        <div class="hero-overlay"></div>
        <div class="container position-relative" style="z-index: 1; max-width: 900px;">
            <h1 class="display-1 fw-bold mb-3">SpaceRent</h1>
            <p class="fs-4 opacity-75 mb-3">Your Neighborhood Space Marketplace</p>
            <p class="fs-5 opacity-75 mb-5">
                Discover and rent unique spaces in your community. From studios to event venues, find the perfect space
                for your needs.
            </p>
            <div class="search-container d-flex flex-column flex-sm-row gap-2 p-3 mx-auto rounded-3"
                style="max-width: 800px;">
                <div class="flex-fill d-flex align-items-center px-3 bg-white rounded-pill">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-secondary"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                        </path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <input type="text" class="form-control border-0 bg-transparent" placeholder="Enter your location" />
                </div>
                <div class="flex-fill d-flex align-items-center px-3 bg-white rounded-pill">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-secondary"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m21 21-4.34-4.34"></path>
                        <circle cx="11" cy="11" r="8"></circle>
                    </svg>
                    <input type="text" class="form-control border-0 bg-transparent"
                        placeholder="What space do you need?" />
                </div>
                <button class="btn btn-gradient px-4 py-2 fs-5 fw-semibold text-white rounded-pill"
                    style="background: linear-gradient(to right, #2563eb, #7c3aed);">
                    Search
                </button>
            </div>
            <div class="row text-center mt-5 text-white mx-auto" style="max-width: 700px;">
                <div class="col-12 col-sm-4 mb-4">
                    <div class="stats-number">10,000+</div>
                    <div class="stats-label">Spaces Available</div>
                </div>
                <div class="col-12 col-sm-4 mb-4">
                    <div class="stats-number">50+</div>
                    <div class="stats-label">Cities</div>
                </div>
                <div class="col-12 col-sm-4 mb-4">
                    <div class="stats-number">25,000+</div>
                    <div class="stats-label">Happy Renters</div>
                </div>
            </div>
        </div>
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg"
            class="position-absolute  start-0 end-0" style="z-index:1;bottom: -1px;">
            <path
                d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                fill="white"></path>
        </svg>

    </section>

    <!-- Why Choose SpaceRent Section -->
    <section class="py-5 bg-white">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-5">
                <h2 class="text-4xl fw-bold text-gray-900 mb-3">Why Choose SpaceRent?</h2>
                <p class="text-xl text-secondary mx-auto" style="max-width: 600px;">We make finding and renting spaces
                    simple, safe, and affordable</p>
            </div>
            <div class="row g-4">
                <?php
                $features = [
                    ['title' => 'Verified Spaces', 'desc' => 'All spaces are verified and inspected for quality and safety', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path><path d="m9 12 2 2 4-4"></path></svg>'],
                    ['title' => 'Flexible Booking', 'desc' => 'Book by the hour, day, or month - whatever suits your needs', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>'],
                    ['title' => 'Best Prices', 'desc' => 'Competitive pricing with transparent fees and no hidden costs', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dollar-sign" viewBox="0 0 24 24" aria-hidden="true"><line x1="12" x2="12" y1="2" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>'],
                    ['title' => 'Community Driven', 'desc' => 'Connect with local space owners and build relationships', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users" viewBox="0 0 24 24" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><path d="M16 3.128a4 4 0 0 1 0 7.744"></path><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><circle cx="9" cy="7" r="4"></circle></svg>'],
                    ['title' => 'Top Rated', 'desc' => 'Read reviews from real renters and make informed decisions', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star" viewBox="0 0 24 24" aria-hidden="true"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>'],
                    ['title' => 'Local Discovery', 'desc' => 'Find unique spaces right in your neighborhood', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map" viewBox="0 0 24 24" aria-hidden="true"><path d="M14.106 5.553a2 2 0 0 0 1.788 0l3.659-1.83A1 1 0 0 1 21 4.619v12.764a1 1 0 0 1-.553.894l-4.553 2.277a2 2 0 0 1-1.788 0l-4.212-2.106a2 2 0 0 0-1.788 0l-3.659 1.83A1 1 0 0 1 3 19.381V6.618a1 1 0 0 1 .553-.894l4.553-2.277a2 2 0 0 1 1.788 0z"></path><path d="M15 5.764v15"></path><path d="M9 3.236v15"></path></svg>'],
                ];
                foreach ($features as $feature):
                    ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="feature-card p-4 text-center h-100">
                            <div class="icon-bg mx-auto"><?= $feature['icon'] ?></div>
                            <h3 class="h5 text-dark fw-semibold"><?= htmlspecialchars($feature['title']) ?></h3>
                            <p><?= htmlspecialchars($feature['desc']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5 bg-gradient-to-br from-blue-50 to-purple-50"
        style="background: linear-gradient(to bottom right, #eff6ff, #e0e7ff);">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-5">
                <h2 class="text-4xl fw-bold text-gray-900 mb-3">How It Works</h2>
                <p class="text-xl text-secondary mx-auto" style="max-width: 600px;">Three simple steps to find your
                    perfect space</p>
            </div>
            <div class="row g-4">
                <?php
                $steps = [
                    ['title' => 'Search & Discover', 'desc' => 'Browse thousands of unique spaces in your area', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search" viewBox="0 0 24 24" aria-hidden="true"><path d="m21 21-4.34-4.34"></path><circle cx="11" cy="11" r="8"></circle></svg>'],
                    ['title' => 'Book Instantly', 'desc' => 'Select your dates and book with just a few clicks', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>'],
                    ['title' => 'Access & Enjoy', 'desc' => 'Get instant access and start using your space', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-key" viewBox="0 0 24 24" aria-hidden="true"><path d="m15.5 7.5 2.3 2.3a1 1 0 0 0 1.4 0l2.1-2.1a1 1 0 0 0 0-1.4L19 4"></path><path d="m21 2-9.6 9.6"></path><circle cx="7.5" cy="15.5" r="5.5"></circle></svg>'],
                ];
                foreach ($steps as $index => $step):
                    ?>
                    <div class="col-12 col-md-4 position-relative text-center">
                        <div class="icon-bg rounded-circle mx-auto mb-4 shadow"
                            style="width: 80px; height: 80px; background: linear-gradient(to bottom right, #2563eb, #7c3aed);">
                            <?= $step['icon'] ?>
                        </div>
                        <?php if ($index < 2): ?>
                            <div class="position-absolute top-50 start-100 translate-middle-y d-none d-md-block"
                                style="width: 100px; height: 2px; background: linear-gradient(to right, #93c5fd, #a78bfa);">
                            </div>
                        <?php endif; ?>
                        <h3 class="h4 fw-semibold text-gray-900 mb-2"><?= htmlspecialchars($step['title']) ?></h3>
                        <p class="text-secondary"><?= htmlspecialchars($step['desc']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Popular Space Categories Section -->
    <section class="py-5 bg-white">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-5">
                <h2 class="text-4xl fw-bold text-gray-900 mb-3">Popular Space Categories</h2>
                <p class="text-xl text-secondary mx-auto" style="max-width:600px;">
                    Explore spaces perfect for every occasion
                </p>
            </div>
            <div class="row g-4">
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="view_details.php?category=Creative%20Studios"
                        class="category-card overflow-hidden position-relative d-block text-decoration-none">
                        <img src="https://images.unsplash.com/photo-1556912172-45b7abe8b7e1?w=800&q=80"
                            alt="Creative Studios" class="category-image" loading="lazy" />
                        <div class="category-overlay"></div>
                        <div class="position-absolute bottom-0 start-0 end-0 p-4 text-white">
                            <h3 class="h5 fw-bold mb-1">Creative Studios</h3>
                            <p class="opacity-75 m-0">2,500+ spaces</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="view_details.php?category=Event%20Venues"
                        class="category-card overflow-hidden position-relative d-block text-decoration-none">
                        <img src="https://images.unsplash.com/photo-1519167758481-83f29da8c2b0?w=800&q=80"
                            alt="Event Venues" class="category-image" loading="lazy" />
                        <div class="category-overlay"></div>
                        <div class="position-absolute bottom-0 start-0 end-0 p-4 text-white">
                            <h3 class="h5 fw-bold mb-1">Event Venues</h3>
                            <p class="opacity-75 m-0">1,800+ spaces</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="view_details.php?category=Meeting%20Rooms"
                        class="category-card overflow-hidden position-relative d-block text-decoration-none">
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&q=80"
                            alt="Meeting Rooms" class="category-image" loading="lazy" />
                        <div class="category-overlay"></div>
                        <div class="position-absolute bottom-0 start-0 end-0 p-4 text-white">
                            <h3 class="h5 fw-bold mb-1">Meeting Rooms</h3>
                            <p class="opacity-75 m-0">3,200+ spaces</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="view_details.php?category=Workshop%20Spaces"
                        class="category-card overflow-hidden position-relative d-block text-decoration-none">
                        <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&q=80"
                            alt="Workshop Spaces" class="category-image" loading="lazy" />
                        <div class="category-overlay"></div>
                        <div class="position-absolute bottom-0 start-0 end-0 p-4 text-white">
                            <h3 class="h5 fw-bold mb-1">Workshop Spaces</h3>
                            <p class="opacity-75 m-0">1,500+ spaces</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="text-center mt-5">
                <button class="btn btn-gradient px-4 py-3 fs-5 fw-semibold text-white rounded-pill"
                    style="background: linear-gradient(to right, #2563eb, #7c3aed);">
                    Explore All Categories
                </button>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="py-5 bg-dark text-light">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="row gy-4 gy-md-0">
                <div class="col-12 col-md-3">
                    <h3 class="fw-bold mb-3 text-white">SpaceRent</h3>
                    <p class="text-secondary">Your neighborhood space marketplace</p>
                </div>
                <div class="col-6 col-md-3">
                    <h4 class="fw-semibold mb-3">For Renters</h4>
                    <ul class="list-unstyled text-secondary">
                        <li><a href="#" class="text-decoration-none text-secondary d-block mb-2 hover:text-white">Browse
                                Spaces</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary d-block mb-2 hover:text-white">How It
                                Works</a></li>
                        <li><a href="#"
                                class="text-decoration-none text-secondary d-block mb-2 hover:text-white">Pricing</a>
                        </li>
                        <li><a href="#" class="text-decoration-none text-secondary d-block mb-2 hover:text-white">Help
                                Center</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3">
                    <h4 class="fw-semibold mb-3">For Owners</h4>
                    <ul class="list-unstyled text-secondary">
                        <li><a href="#" class="text-decoration-none text-secondary d-block mb-2 hover:text-white">List
                                Your Space</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary d-block mb-2 hover:text-white">Owner
                                Resources</a></li>
                        <li><a href="#"
                                class="text-decoration-none text-secondary d-block mb-2 hover:text-white">Success
                                Stories</a></li>
                        <li><a href="#"
                                class="text-decoration-none text-secondary d-block mb-2 hover:text-white">Community</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-3">
                    <h4 class="fw-semibold mb-3">Company</h4>
                    <ul class="list-unstyled text-secondary">
                        <li><a href="#" class="text-decoration-none text-secondary d-block mb-2 hover:text-white">About
                                Us</a></li>
                        <li><a href="#"
                                class="text-decoration-none text-secondary d-block mb-2 hover:text-white">Careers</a>
                        </li>
                        <li><a href="#"
                                class="text-decoration-none text-secondary d-block mb-2 hover:text-white">Press</a></li>
                        <li><a href="#"
                                class="text-decoration-none text-secondary d-block mb-2 hover:text-white">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 border-secondary" />
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
                <p class="text-secondary mb-3 mb-sm-0">&copy; 2024 SpaceRent. All rights reserved.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-outline-light rounded-circle p-2"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg></a>
                    <a href="#" class="btn btn-outline-light rounded-circle p-2"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z">
                            </path>
                        </svg></a>
                    <a href="#" class="btn btn-outline-light rounded-circle p-2"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                        </svg></a>
                    <a href="#" class="btn btn-outline-light rounded-circle p-2"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                            </path>
                            <rect width="4" height="12" x="2" y="9"></rect>
                            <circle cx="4" cy="4" r="2"></circle>
                        </svg></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>