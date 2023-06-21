<!DOCTYPE html>
<html>
<head>
  <style>
    
 .reviews{
   background-color: var(--light-bg);
}

.reviews .box-container{
   max-width: 1200px;
   margin:0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
   align-items: center;
   gap:1.5rem;
   justify-content: center;
}

.reviews .box-container .box{
   background-color: var(--white);
   box-shadow: var(--box-shadow);
   text-align: center;
   padding:2vmax;
}

.reviews .box-container .box img{
   height: 10rem;
   width: 10rem;
   border-radius: 50%;
}

.reviews .box-container .box p{
   padding:1rem 0;
   line-height: 2;
   color:var(--light-color);
   font-size: 1.5rem;
}

.reviews .box-container .box .stars{
   background-color: var(--light-bg);
   display: inline-block;
   margin:.5rem 0;
   border-radius: .5rem;
   border:var(--border);
   padding:.5rem 1.5rem;
}

.reviews .box-container .box .stars i{
   font-size: 1.7rem;
   color:var(--orange);
   margin:.2rem;
}

.reviews .box-container .box h3{
   font-size: 2rem;
   color:var(--black);
   margin-top: 1rem;
}

.authors .box-container{
   max-width: 1200px;
   margin:0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
   align-items: center;
   gap:1.5rem;
   justify-content: center;
}

.authors .box-container .box{
   position: relative;
   text-align: center;
   box-shadow: var(--box-shadow);
   overflow: hidden;
   border-radius: .5rem;
}

.authors .box-container .box img{
   width: 100%;
   height: 40rem;
   object-fit: cover;
}

.authors .box-container .box .share{
   position: absolute;
   top:0; left:-10rem;
}

.authors .box-container .box:hover .share{
   left: 1rem;
}

.authors .box-container .box .share a{
   height: 4.5rem;
   width: 4.5rem;
   line-height: 4.5rem;
   font-size: 2rem;
   background-color: var(--white);
   border:var(--border);
   display: block;
   margin-top: 1rem;
   color:var(--black);
}

.authors .box-container .box .share a:hover{
   background-color: var(--black);
   color:var(--white);
}

.authors .box-container .box h3{
   font-size: 2.5rem;
   color:var(--black);
   padding:1.5rem;
   background-color: var(--white);
}
  </style>
</head>
<body>
  <section class="reviews">

    <h1 class="title">client's reviews</h1>

    <div class="box-container">

      <div class="box">
        <img src="images/pic-1.jpg" alt="">
        <p>I'm so impressed with the customer service at Veridis. I had a question about sizing, and their support team responded to my email within an hour with helpful advice. I ended up ordering a pair of pants that fit like a dream. I appreciate how easy it was to shop with them, and I'll be a loyal customer from now on.</p>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h3>Nico Pacuit</h3>
      </div>

      <div class="box">
        <img src="images/pic-2.jpg" alt="">
        <p>I recently bought a dress from Veridis, and I couldn't be happier with my purchase. The quality of the fabric is excellent, and the fit is perfect. I received so many compliments on the dress when I wore it to a party. I will definitely be shopping at Veridis again!</p>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h3>Llane Benting</h3>
      </div>

      <div class="box">
        <img src="images/pic-3.jpg" alt="">
        <p>I'm always hesitant to buy clothes online, but I took a chance on Veridis, and I'm so glad I did. The clothes are even better than I expected - high-quality, trendy, and affordable. The shipping was fast, and the items were packaged beautifully. I've already placed my second order and can't wait to see what they have in store next!</p>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h3>Deanielle Dagondon</h3>
      </div>

    </div>

  </section>

  <section class="authors">

    <h1 class="title">best designers</h1>

    <div class="box-container">

      <div class="box">
        <img src="images/author-1.jpg" alt="">
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
          <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Coco Chanel</h3>
      </div>

      <div class="box">
        <img src="images/author-2.jpg" alt="">
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
          <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Ralph Lauren</h3>
      </div>

      <div class="box">
        <img src="images/author-3.jpg" alt="">
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
          <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Christian Dior</h3>
      </div>

      <div class="box">
        <img src="images/author-4.jpg" alt="">
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
          <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Donatella Versace</h3>
      </div>

      <div class="box">
        <img src="images/author-5.jpg" alt="">
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
          <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Marc Jacobs</h3>
      </div>

      <div class="box">
        <img src="images/author-6.jpg" alt="">
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
          <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Calvin Klein</h3>
      </div>

    </div>

  </section>
</body>
</html>
