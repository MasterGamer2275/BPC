<!DOCTYPE html>
<html>

<form>
<textarea id = "quotes" name="quotes" rows="2" cols="50" diabled style="background-color:rgb(173, 103, 79);resize:none;color: yellow;border: none;font-size: 130%;"></textarea>
</form>


<script>
let i=0;
var quotes = ["“All that we are is the result of what we have thought. The mind is everything. What we think we become.” – Gautama Buddha.", "“Political tyranny is nothing compared to social tyranny and a reformer who defies society is a more courageous man than a politician who defies government.” – B. R. Ambedkar", "“The tree laden with fruits always bends low. If you wish to be great, be lowly and meek.” – Sri Ramakrishna Paramahamsa","“Democracy is good. I say this because other systems are worse.” – Jawaharlal Nehru", "“We are what our thoughts have made us; so take care about what you think. Words are secondary. Thoughts live; they travel far.” – Swami Vivekananda","“Prophet Mohammed would have no objection to The Satanic Verses.” – Salman Rushdie", "“Arise, Awake and Stop not until the goal is reached.” – Swami Vivekananda.","“I am not very good at statistics. I am also a poor thinker.” – Manmohan Singh", "“You must be the change you want to see in the world.” – Mahatma Gandhi.","“No one would starve in independent India. Its grain would not be exported. Cloth would not be imported by it. Its leaders would not use a foreign language and finding justice in it would be neither costly nor difficult.” – Sardar Patel", "“Failure comes only when we forget our ideals and objectives and principles.” – Jawaharlal Nehru","“I am an Indian. In fact, I feel like a foreigner when I go abroad.” – Sonia Gandhi", "“You must learn to be still in the midst of activity and to be vibrantly alive in repose.” – Indira Gandhi","“A politician should not be written off till he or she is cremated.” – George Fernandes", "“There is an important distinction between barriers to entry and barriers to imitation.” – C.K.Prahalad","“I was assured of a place in the team without trials, but I had a feeling it was not fair…when many of my friends were fighting badly for a place and had to prove their mettle in the inter-provincial tournament.” – Dhyan ", "“To succeed in your mission, you must have single-minded devotion to your goal.” – Abdul Kalam","“No apology is necessary for being truthful to the echoes of one’s mother tongue.” – Mulk Raj Anand", "“Do not say, ‘It is morning,’ and dismiss it with a name of yesterday. See it for the first time as a newborn child that has no name.” – Rabindranath Tagore","“The biggest problem in the world today is not poverty or disease but the lack of love and charity and the feeling of being unwanted.” – Mother Teresa", "“No religion has mandated killing others as a requirement for its sustenance or promotion.” – Dr.A.P.J.Abdul Kalam","“Indian men are still used to the traditional role given to women; they want intelligent girls for company but not to marry…(they) have yet to taste and relish the company of mature women.” – Amrita Pritam", "“After all, our Killers are our …Brothers!!??” – Bal Gangadhara Tilak","“No girl has offered to go to bed with me in return for a part (in a film). I wish it would happen.” – Manmohan Desai", "“Education is the manifestation of perfection already in a man.” – Swami Vivekananda"];
let x = document.getElementById("quotes");
for (let i = 0; i < quotes.length; i++) {
      x.value = "-"+(quotes[i]);
      setTimeout(2000); // Change image every 2 seconds
  }
</script>
</html>

