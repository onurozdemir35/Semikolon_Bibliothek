<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

  <title>Über uns</title>
  <link rel="stylesheet" href="team.css">
  <link rel="stylesheet" href="header.css">
</head>
<body>





<!--our team-->

<section class="team-slider">
  <div class="container">
    <h2>Unser Team</h2>
    <div class="slider">
      <button class="prev-btn" aria-label="Previous">❮</button>
      <div class="slider-wrapper">
        <div class="slider-track">
          <div class="team-member">
            <img src="bilder_2/santiago.jpg" alt="Team Member 1" class="team-memberpic">
            <h4>Santiago .L. Otalvaro</h4>
            <p>Role</p>
          </div>
          <div class="team-member">
            <img src="bilder_2/paula.jpg" alt="Team Member 2" class="team-memberpic">
            <h4>Paula Saldana</h4>
            <p>Role</p>
          </div>
          <div class="team-member">
            <img src="bilder_2/sakina.jpg" alt="Team Member 3" class="team-memberpic">
            <h4>Sakina Ahamedi</h4>
            <p>Role</p>
          </div>
          <div class="team-member">
              <img src="bilder_2/adel.jpg" alt="Team Member 4" class="team-memberpic">
              <h4>Adel Haj Jumah</h4>
              <p>Role</p>
            </div>
          <div class="team-member">
            <img src="bilder_2/juu.jpg" alt="Team Member 4" class="team-memberpic">
            <h4>Julienne Mizero</h4>
            <p>Role</p>
          </div>
          <div class="team-member">
            <img src="bilder_2/onur.jpg" alt="Team Member 5" class="team-memberpic">
            <h4>Onur Özdemir</h4>
            <p>Role</p>
          </div>
        </div>
      </div>
      <button class="next-btn" aria-label="Next">❯</button>
    </div>
  </div>
</section>


<script>
  const slider = document.querySelector('.slider-track');
  const prevBtn = document.querySelector('.prev-btn');
   const nextBtn = document.querySelector('.next-btn');

         let currentIndex = 0;
          const cardWidth = document.querySelector('.team-member').offsetWidth + 20; // Include gap
          const visibleCards = 3;

         nextBtn.addEventListener('click', () => {
         const maxIndex = slider.children.length - visibleCards;
         if (currentIndex < maxIndex) {
          currentIndex++;
          slider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
}
});

          prevBtn.addEventListener('click', () => {
if (currentIndex > 0) {
currentIndex--;
slider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
}
});
</script>





<!--review and rating section-->

    <div class="app">
      <h2>Unser Bewertung</h2>
         <div class="rating">
              
             <div class="rating_average">
                <h1></h1>
                <div class="star-outer ">
                  <div class="star-inner"></div>
                </div>
                <p> {$total_rating}  </p>
              </div>
              <div class="rating_progress">
             </div>
           </div>
        </div>

  

  <script>

   let data=[
    {
          'star':5,
          'count':9997,
    },
    {
          'star':4,
          'count':39300,
    },
    {
          'star':3,
          'count':25050,
    },
    {
          'star':2,
          'count':10070,
    },
    {
          'star':1,
          'count':5020,
    },
   ]
  let total_rating=0,
  rating_based_on_stars=0;
data.forEach((rating,index)=>{
      total_rating+=rating.count;
      rating_based_on_stars+=rating.count*rating.star
});



     data.forEach(rating=>{
          let rating_progress=`
           <div class="rating_progress-value">
                  <p>${rating.star}<span class="star">&#9733;</span></p>
                  <div class="progress">
                    <div class="bar" style=" width: ${(rating.count/total_rating)*100}%;"></div>
                  </div>
                  <p>${rating.count.toLocaleString()}</p>
                </div>
          `;

          document.querySelector('.rating_progress').innerHTML +=rating_progress;

     });

      let rating_average=(rating_based_on_stars/total_rating).toFixed(1);
     document.querySelector('.rating_average h1').innerHTML=rating_average;
     document.querySelector('.rating_average p').innerHTML=total_rating.toLocaleString();
     document.querySelector('.star-inner').style.width=(rating_average/5)*100+"%";
  </script>
</body>
</html>
