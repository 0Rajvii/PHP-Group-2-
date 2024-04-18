<?php
session_start(); // Place this at the very top of every PHP file
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="js/script.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My E-commerce Website</title>
        <link rel="stylesheet" href="style.css"></link>

    <style>
       /* Banner styling */
.banner {
    position: relative;
    background-image: url('sunglass.jpg');
    background-size: cover;
    background-position: center;
    height: 600px; /* Adjust the height as needed */
    text-align: center;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.banner::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Adjust opacity here */
}

/* Banner text styling */
.banner-text {
    position: relative;
    z-index: 1; /* Ensure the text is above the overlay */
}

.banner-text h2 {
    font-size: 36px;
    margin-bottom: 10px;
}

.banner-text p {
    font-size: 24px;
    margin: 0;
}


        /* Container for products */
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        /* Individual product styling */
        .product {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .product img {
            width: 100%;
            height: 200px; /* Adjust the height as needed */
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .product h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .product p {
            margin-bottom: 10px;
            color: #666;
        }

        .add-to-cart {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-to-cart:hover {
            background-color: #0056b3;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .products {
                grid-template-columns: repeat(2, minmax(250px, 1fr));
            }
        }

        @media (max-width: 576px) {
            .products {
                grid-template-columns: repeat(1, minmax(250px, 1fr));
            }
        }


        

 

        .testimonials {
    background-color: #f9f9f9;
    padding: 50px 0;
    text-align: center;
}

.container {
    position: relative;
    padding: 50px;
}

.testimonial-slider {
    display: flex;
    overflow: hidden;
}

.testimonial {
    flex: 0 0 100%;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    margin: 0 20px;
    max-width: 400px;
    text-align: left;
    transition: transform 0.5s ease;
}

.testimonial-content {
    padding: 20px;
}

.rating {
    margin-bottom: 10px;
}

.rating .star {
    color: #FFD700; /* Gold color for stars */
    font-size: 24px;
}

.testimonial-author {
    display: flex;
    align-items: center;
}

.testimonial-author img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.testimonial-author h3 {
    margin: 0;
    font-size: 16px;
}

.prev-btn,
.next-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: transparent;
    border: none;
    font-size: 24px;
    cursor: pointer;
    outline: none;
}

.prev-btn {
    left: 10px;
}

.next-btn {
    right: 10px;
}

.contact-form-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .contact-form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .contact-form-group {
            margin-bottom: 20px;
        }

        .contact-form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .contact-form-group input,
        .contact-form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            resize: vertical;
        }

        .contact-form-group input:focus,
        .contact-form-group textarea:focus {
            outline: none;
            border-color: #007bff;
        }

        .contact-form-submit {
            display: block;
            width: 100%;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .contact-form-submit:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .contact-form-container {
                padding: 20px;
            }
        }

        .banner {
    position: relative;
    background-image: url('sunglass.jpg');
    background-size: cover;
    background-position: center;
    height: 600px; /* Adjust the height as needed */
    text-align: center;
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.banner::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Adjust opacity here */
}

/* Banner text styling */
.banner-text {
    position: relative;
    z-index: 1; /* Ensure the text is above the overlay */
    text-align: center;
    max-width: 80%;
}

.banner-text h2 {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
}

.banner-text p {
    font-size: 24px;
    margin-bottom: 40px;
}

.banner-btn {
    position: relative;
    z-index: 1;
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 12px 24px;
    border-radius: 4px;
    font-size: 18px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.banner-btn:hover {
    background-color: #0056b3;
}


    </style>


</head>
<body>

<script>





document.addEventListener("DOMContentLoaded", function() {
    const testimonials = document.querySelectorAll(".testimonial");
    let currentTestimonialIndex = 0;

    function showTestimonial(index) {
        testimonials.forEach(testimonial => {
            testimonial.style.transform = `translateX(-${index * 100}%)`;
        });
    }

    function showNextTestimonial() {
        currentTestimonialIndex++;
        if (currentTestimonialIndex >= testimonials.length) {
            currentTestimonialIndex = 0;
        }
        showTestimonial(currentTestimonialIndex);
    }

    function showPrevTestimonial() {
        currentTestimonialIndex--;
        if (currentTestimonialIndex < 0) {
            currentTestimonialIndex = testimonials.length - 1;
        }
        showTestimonial(currentTestimonialIndex);
    }

    document.querySelector(".next-btn").addEventListener("click", showNextTestimonial);
    document.querySelector(".prev-btn").addEventListener("click", showPrevTestimonial);
});


    </script>

<?php include 'header.php'; ?>

<!-- Banner section -->
<div class="banner">
    <div class="banner-text">
        <h2>Welcome to Our E-commerce Website</h2>
        <p>Discover amazing products at great prices!</p>
    </div>
    <a href="show_products.php">
  <button class="banner-btn">Shop Now</button>
</a>
</div>

<center><h1>Our Products</h1></center>

<!-- Products section -->
<section class="products">
    <?php
        include 'limit_product.php';
    ?>
</section>


<section class="testimonials">
<h2>What Our Customers Say</h2>

    <div class="container">
        <div class="testimonial-slider">
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>The design of these sunglasses is top-notch. I've received many compliments when wearing them.</p>
                    <div class="rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9734;</span>
                    </div>
                    <div class="testimonial-author">
                        <img src="images/threeev.png" alt="Customer Avatar">
                        <h3>John Doe</h3>
                    </div>
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>I'm very satisfied with my purchase. These sunglasses exceeded my expectations.</p>
                    <div class="rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9734;</span>
                    </div>
                    <div class="testimonial-author">
                        <img src="images/oneav.jpeg" alt="Customer Avatar">
                        <h3>Jane Smith</h3>
                    </div>
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>Great value for money. These sunglasses feel sturdy and well-made.</p>
                    <div class="rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9734;</span>
                    </div>
                    <div class="testimonial-author">
                        <img src="images/twoav.png" alt="Customer Avatar">
                        <h3>Emily Brown</h3>
                    </div>
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>Fast shipping and easy returns. Couldn't ask for a better shopping experience.</p>
                    <div class="rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9734;</span>
                    </div>
                    <div class="testimonial-author">
                        <img src="images/oneav.jpeg" alt="Customer Avatar">
                        <h3>Sarah Taylor</h3>
                    </div>
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>I've bought sunglasses from many places, but these are by far the best quality for the price.</p>
                    <div class="rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9734;</span>
                    </div>
                    <div class="testimonial-author">
                        <img src="images/oneav.jpeg" alt="Customer Avatar">
                        <h3>Amanda Garcia</h3>
                    </div>
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>These sunglasses are amazing! They fit perfectly and look great.</p>
                    <div class="rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9734;</span>
                    </div>
                    <div class="testimonial-author">
                        <img src="avatar3.jpg" alt="Customer Avatar">
                        <h3>Ryan Martinez</h3>
                    </div>
                </div>
            </div>
        </div>
        <button class="prev-btn">&#10094;</button>
        <button class="next-btn">&#10095;</button>
    </div>

    <div class="contact-form-container">
        <h1 class="contact-form-title">Contact Us</h1>
        <form action="submit-contact-form.php" method="post">
            <div class="contact-form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="contact-form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="contact-form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="contact-form-submit">Send Message</button>
           
        </div>
        </form>
        
    </div>

    </div>
</section>
<?php include 'footer.php'; ?>

</body>
</html>
