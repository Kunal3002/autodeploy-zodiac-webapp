<?php
// Get inputs via POST
$name      = htmlspecialchars($_POST['name']      ?? '');
$email     = htmlspecialchars($_POST['email']     ?? '');
$birthdate = htmlspecialchars($_POST['birthdate'] ?? '');

// Convert birthdate into month & day
if (!empty($birthdate)) {
    $date  = new DateTime($birthdate);
    $month = (int)$date->format('m');
    $day   = (int)$date->format('d');
} else {
    $month = 0;
    $day   = 0;
}

// Zodiac function: returns [key, label]
function getZodiacSign($d, $m) {
    if (($m==3  && $d>=21) || ($m==4  && $d<=19)) return ['aries',       'Aries ♈'];
    if (($m==4  && $d>=20) || ($m==5  && $d<=20)) return ['taurus',      'Taurus ♉'];
    if (($m==5  && $d>=21) || ($m==6  && $d<=20)) return ['gemini',      'Gemini ♊'];
    if (($m==6  && $d>=21) || ($m==7  && $d<=22)) return ['cancer',      'Cancer ♋'];
    if (($m==7  && $d>=23) || ($m==8  && $d<=22)) return ['leo',         'Leo ♌'];
    if (($m==8  && $d>=23) || ($m==9  && $d<=22)) return ['virgo',       'Virgo ♍'];
    if (($m==9  && $d>=23) || ($m==10 && $d<=22)) return ['libra',       'Libra ♎'];
    if (($m==10 && $d>=23) || ($m==11 && $d<=21)) return ['scorpio',     'Scorpio ♏'];
    if (($m==11 && $d>=22) || ($m==12 && $d<=21)) return ['sagittarius', 'Sagittarius ♐'];
    if (($m==12 && $d>=22) || ($m==1  && $d<=19)) return ['capricorn',   'Capricorn ♑'];
    if (($m==1  && $d>=20) || ($m==2  && $d<=18)) return ['aquarius',    'Aquarius ♒'];
    if (($m==2  && $d>=19) || ($m==3  && $d<=20)) return ['pisces',      'Pisces ♓'];
    return ['unknown', 'Unknown'];
}

// Daily message per zodiac (5–6 lines / sentences)
function getDailyMessage($key) {
    switch ($key) {
        case 'aries':
            return "Today is about courage and clean decisions. Take initiative on one task you've been delaying and finish it fully. \
Your natural leadership will quietly influence people around you. Avoid reacting too fast to small problems—breathe once before you answer. \
A short walk or stretch in the afternoon will clear your head. End the day by writing one bold goal for tomorrow.";
        case 'taurus':
            return "Stability is your theme today. Focus on small, practical wins that make your life more comfortable and calm. \
Spend a few minutes organising your workspace or finances—it will reduce silent stress. Someone may lean on you for advice; answer slowly and honestly. \
A good meal or cup of tea is more powerful than you think. Before bed, note three simple things you’re grateful for.";
        case 'gemini':
            return "Your mind is sharp and curious today. Use this energy to learn something small but new—a tool, concept, or idea. \
Conversations will flow easily, so choose them wisely and avoid gossip that drains you. Write down your ideas instead of keeping them in your head. \
Switch tasks with intention rather than distraction. A short message to an old friend could brighten both your days.";
        case 'cancer':
            return "Emotion and intuition guide you strongly today. Protect your energy by setting one gentle boundary where you need it. \
Home or family matters may ask for attention; respond with patience instead of urgency. Nourish yourself with good food and a calm moment alone. \
If something bothers you, write it down instead of carrying it silently. End the day with a small comforting ritual you truly enjoy.";
        case 'leo':
            return "Your presence is extra noticeable today. Use it to encourage others rather than seeking approval. \
Take pride in one task and do it with full attention—it will shine more than you expect. Compliments given sincerely will come back to you later. \
Be careful not to overspend just to impress anyone. Finish the day by appreciating one thing you genuinely like about yourself.";
        case 'virgo':
            return "Your eye for detail is powerful today. Choose one area of your life that feels messy and improve it by just 1%. \
Perfection isn’t required—progress is. Double-check important messages or numbers before sending. \
Offer help only where it’s truly welcomed so you don’t exhaust yourself. A short stretch or tidy-up before sleep will calm your mind.";
        case 'libra':
            return "Balance and harmony are your keywords today. Notice where things feel one-sided and adjust gently, not dramatically. \
You may need to make a decision—listen to both logic and fairness. A pleasant conversation can solve more than a long argument. \
Beautify a small corner of your space; it will lift your mood. In the evening, disconnect from screens a bit earlier than usual.";
        case 'scorpio':
            return "Your intuition and focus are intense today. Use them to go deep on one important task instead of scattering your energy. \
A hidden truth or insight may surface—handle it with maturity, not suspicion. Protect your privacy but don’t shut people out completely. \
Transform one small habit that no longer serves you. Reflect tonight on what you truly want, not what you think you should want.";
        case 'sagittarius':
            return "Adventure and optimism colour your day. Even if you can’t travel, explore through learning, reading, or new experiences. \
Share your ideas, but also listen so others feel heard. Avoid promising more than you realistically can deliver. \
A bit of humour will diffuse tension around you. Before sleep, map one exciting goal into a tiny step you can take tomorrow.";
        case 'capricorn':
            return "Discipline and long-term thinking support you today. Focus on one responsibility that will make future-you thankful. \
You may feel pressure, but steady effort will impress more than speed. Avoid being too hard on yourself or others. \
Take a short break to move your body and reset. Tonight, acknowledge one achievement you usually overlook.";
        case 'aquarius':
            return "Original ideas come to you more easily today. Use them to improve a system, process, or routine in your life. \
Connect with people who share your values rather than arguing with those who don’t. Technology or online spaces may bring an opportunity. \
Remember to care for your body while your mind is busy. End the day imagining one positive change you’d like to see in the world.";
        case 'pisces':
            return "Your sensitivity and creativity are highlighted today. Give yourself a little time for music, art, or quiet reflection. \
Be gentle with your boundaries—help others, but don’t absorb every problem. Trust subtle feelings, but confirm them with facts. \
Water, whether a shower or a drink, will refresh your mood. Before bed, release worries by writing them down and letting them go.";
        default:
            return "Today holds space for calm progress. Move gently but clearly toward what matters, and protect your focus from needless noise.";
    }
}

list($signKey, $signLabel) = getZodiacSign($day, $month);
$message = getDailyMessage($signKey);


$dsn  = "mysql:host=localhost;dbname=autodeploy_db;charset=utf8";
$user = "projectuser";
$pass = "deploy";

$dbError = "";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql  = "INSERT INTO users (name, email, birthdate, zodiac) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $birthdate, $signLabel]);

} catch (PDOException $e) {
    $dbError = "Database Insert Error: " . $e->getMessage();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Your Day</title>
  <style>
    body { font-family: Arial; text-align:center; margin-top:80px; background:#f8f9fa; }
    .card {
        display:inline-block; padding:30px 50px; background:#fff; border-radius:12px;
        box-shadow:0 6px 20px rgba(0,0,0,0.08); max-width:600px;
    }
    h1 { color:#007bff; }
    .error { color:red; font-weight:bold; margin-bottom:20px; }
    p { line-height:1.5; }
  </style>
</head>
<body>

<?php if (!empty($dbError)) { ?>
    <div class="error"><?php echo $dbError; ?></div>
<?php } ?>

<div class="card">
    <h1>Hello, <?php echo htmlspecialchars(ucfirst($name)); ?>!</h1>

    <p>Your Email: <strong><?php echo htmlspecialchars($email); ?></strong></p>
    <p>Your Birthdate: <strong><?php echo htmlspecialchars($birthdate); ?></strong></p>
    <p>Your Zodiac: <strong><?php echo htmlspecialchars($signLabel); ?></strong></p>

    <p><strong><?php echo nl2br(htmlspecialchars($message)); ?></strong></p>

    <p><a href="index.php">🔙 Back</a></p>
</div>

</body>
</html>

