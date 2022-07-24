@extends('user.layout.app')
@section('title')
@section('section')
<section id="hero" class="hero d-flex align-items-center">

    <div class="container">
        <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">We offer modern solutions for growing your business</h1>
            <h2 data-aos="fade-up" data-aos-delay="400">We are team of talented designers making websites with Bootstrap</h2>
            <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
                <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Started</span>
                <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset('hero.png') }}" class="img-fluid" alt="">
        </div>
        </div>
    </div>

    </section>
@endsection
@section('content')
<section id="about" class="about">

    <div class="container" data-aos="fade-up">
        <div class="row gx-0">

            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="content">
                    <h3>Who We Are</h3>
                    <h2>Expedita voluptas omnis cupiditate totam eveniet nobis sint iste. Dolores est repellat corrupti
                        reprehenderit.</h2>
                    <p>
                        Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt et. Inventore et et dolor
                        consequatur itaque ut voluptate sed et. Magnam nam ipsum tenetur suscipit voluptatum nam et est
                        corrupti.
                    </p>
                    <div class="text-center text-lg-start">
                        <a href="#"
                            class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>Read More</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{ asset('berzalogo.jpg') }}" class="img-fluid" alt="">
            </div>

        </div>
    </div>

</section>
<section id="values" class="values">

    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <p>View Course</p>
        </header>
        <div class="row">
            @foreach ($kelas as $item)
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="box">
                    <img src="{{ asset('materiimage/'. $item->image)}}" class="img-fluid" alt="">
                    <h3>{{ $item->title }}</h3>
                    <p>{{ $item->description }}</p>
                </div>
            </div>
            @endforeach
            <div class="col-lg-4">
                <div class="post-box">
                    <div class="post-img"><img src="assets/img/blog/blog-1.jpg" class="img-fluid" alt=""></div>
                    <span class="post-date">Tue, September 15</span>
                    <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit</h3>
                    <a href="blog-singe.html" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">

    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </header>

      <div class="row gy-4">

        <div class="col-lg-6">

          <div class="row gy-4">
            <div class="col-md-6">
              <div class="info-box">
                <i class="bi bi-geo-alt"></i>
                <h3>Address</h3>
                <p>A108 Adam Street,<br>New York, NY 535022</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box">
                <i class="bi bi-telephone"></i>
                <h3>Call Us</h3>
                <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box">
                <i class="bi bi-envelope"></i>
                <h3>Email Us</h3>
                <p>info@example.com<br>contact@example.com</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box">
                <i class="bi bi-clock"></i>
                <h3>Open Hours</h3>
                <p>Monday - Friday<br>9:00AM - 05:00PM</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-6">
          <form action="forms/contact.php" method="post" class="php-email-form">
            <div class="row gy-4">

              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
              </div>

              <div class="col-md-6 ">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
              </div>

              <div class="col-md-12">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
              </div>

              <div class="col-md-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>

                <button type="submit">Send Message</button>
              </div>

            </div>
          </form>

        </div>

      </div>

    </div>

  </section><!-- End Contact Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

  <div class="footer-newsletter">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 text-center">
          <h4>Our Newsletter</h4>
          <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
        </div>
        <div class="col-lg-6">
          <form action="" method="post">
            <input type="email" name="email"><input type="submit" value="Subscribe">
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-top">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="index.html" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span>FlexStart</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links mt-3">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>
            A108 Adam Street <br>
            New York, NY 535022<br>
            United States <br><br>
            <strong>Phone:</strong> +1 5589 55488 55<br>
            <strong>Email:</strong> info@example.com<br>
          </p>

        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>FlexStart</span></strong>. All Rights Reserved
    </div>
  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

@endsection
