<!DOCTYPE html>
<html>
<style>
* {box-sizing: border-box;}
//body {font-family: Verdana, sans-serif;}
body {font-family: "Trebuchet MS", sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Quotes display container */
.quotes-container {
  position: absolute;
  top: 30%;
  left: 50%;
  width: 80%;
  height: auto;
  border: none;
  background-color: rgb(173, 103, 79);
  color: yellow;
  display:active;
  font-size: 17px;
}

.quotes-textarea {
  rows:2;
  cols:50;
  background-color: rgb(173, 103, 79);
  resize:none;
  color: yellow;
  border: none;
  //font-size: 130%;
  font-size: 1.35em;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.2s;
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

  @media screen and (max-width: 600px) {
    /* Adjust font size for smaller screens */
    quotes-textarea {
      font-size: 0.5em;
    }
  }

  @media screen and (min-width: 1200px) {
    /* Adjust font size for larger screens */
    quotes-textarea {
      font-size: 1.2em;
    }
  }
  @media screen and (max-width: 300px) {
    /* Adjust font size for larger screens */
    quotes-textarea {
      display: none;
    }
  }
</style>
</head>
<body>

<div class="quotes-textarea">
  <p class="quotelinks">"Imagination is more important than knowledge. For knowledge is limited to all we know and understand, while imagination embraces the entire world, and all there ever will be to know and understand." – Albert Einstein</p>
  <p class="quotelinks">“All that we are is the result of what we have thought. The mind is everything. What we think we become.” – Gautama Buddha.</p>
  <p class="quotelinks">“Political tyranny is nothing compared to social tyranny and a reformer who defies society is a more courageous man than a politician who defies government.” – B. R. Ambedkar</p>
  <p class="quotelinks">“The tree laden with fruits always bends low. If you wish to be great, be lowly and meek.” – Sri Ramakrishna Paramahamsa</p>
  <p class="quotelinks">“Democracy is good. I say this because other systems are worse.” – Jawaharlal Nehru</p>
  <p class="quotelinks">“We are what our thoughts have made us; so take care about what you think. Words are secondary. Thoughts live; they travel far.” – Swami Vivekananda</p>
  <p class="quotelinks">“If you can't explain it simply, you don't understand it well enough.” – Albert Einstein</p>
  <p class="quotelinks">“Prophet Mohammed would have no objection to The Satanic Verses.” – Salman Rushdie</p>
  <p class="quotelinks">“Arise, Awake and Stop not until the goal is reached.” – Swami Vivekananda.</p>
  <p class="quotelinks">“I am not very good at statistics. I am also a poor thinker.” – Manmohan Singh"</p>
  <p class="quotelinks">“Failure comes only when we forget our ideals and objectives and principles.” – Jawaharlal Nehru</p>
  <p class="quotelinks">“I am an Indian. In fact, I feel like a foreigner when I go abroad.” – Sonia Gandhi</p>
  <p class="quotelinks">“You must learn to be still in the midst of activity and to be vibrantly alive in repose.” – Indira Gandhi</p>
  <p class="quotelinks">“A politician should not be written off till he or she is cremated.” – George Fernandes</p>
  <p class="quotelinks">“There is an important distinction between barriers to entry and barriers to imitation.” – C.K.Prahalad</p>
  <p class="quotelinks">“We cannot solve our problems with the same thinking we used when we created them.” – Albert Einstein</p>
  <p class="quotelinks">“To succeed in your mission, you must have single-minded devotion to your goal.” – Abdul Kalam</p>
  <p class="quotelinks">“No apology is necessary for being truthful to the echoes of one’s mother tongue.” – Mulk Raj Anand</p>
  <p class="quotelinks">“Do not say, ‘It is morning,’ and dismiss it with a name of yesterday. See it for the first time as a newborn child that has no name.” – Rabindranath Tagore</p>
  <p class="quotelinks">“The biggest problem in the world today is not poverty or disease but the lack of love and charity and the feeling of being unwanted.” – Mother Teresa</p>
  <p class="quotelinks">“No religion has mandated killing others as a requirement for its sustenance or promotion.” – Dr.A.P.J.Abdul Kalam</p>
  <p class="quotelinks">“After all, our Killers are our …Brothers!!??” – Bal Gangadhara Tilak</p>
  <p class="quotelinks">“No girl has offered to go to bed with me in return for a part (in a film). I wish it would happen.” – Manmohan Desai</p>
  <p class="quotelinks">“Education is the manifestation of perfection already in a man.” – Swami Vivekananda</p>
  <p class="quotelinks">“We cannot solve our problems with the same thinking we used when we created them."– Albert Einstein</p>
  <p class="quotelinks">“You must be the change you want to see in the world.” – Mahatma Gandhi.</p>
</div>


<script>
let QuoteIndex = 0;
ShowQuotes();

function ShowQuotes() {
  let i;
  let slides = document.getElementsByClassName("quotelinks");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  QuoteIndex++;
  if (QuoteIndex > slides.length) {QuoteIndex = 1}
  slides[QuoteIndex-1].style.display = "block";
  setTimeout(ShowQuotes, 15000); // Change quote text every 15 seconds
}
</script>

</body>
</html> 