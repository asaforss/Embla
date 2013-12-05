<?php 
/**
 * This is a Embla pagecontroller.
 *
 */
// Include the essential config-file which also creates the $embla variable with its defaults.
include(__DIR__.'/config.php'); 
 
 
// Do it and store it all in variables in the Embla container.
$embla['title'] = "Me-sida";
 
$embla['main'] = "<h1>Redovisningar</h1>
    <article class ='col2'>
    <h2>Kmom05: Lagra innehåll i databasen</h2>
    <h3>CContent</h3>
    <p>Jag gjorde guiden eller rättare sagt läste igenom den flera gånger och kopierade mos kod. Sedan skulle jag sätta igång med uppgifterna. 
    Jag fastnade redan här vid CContent. Jag förstod tex inte vad initieringen av tabellstrukturen innebar. Det kändes ganska tungt helt plötsligt 
    och jag tog en liten paus och började läsa kurslitteraturen till första momentet i phpmvc kursen istället. Som tur var visade sig den vara högst 
    relevant för denna kurs också! Riktigt intressant. Därefter blev mina barn sjuka och jag fick ett uppehåll på en vecka. När jag kom tillbaks till
    uppgiften igen ställde jag en fråga till Mikael på forumet och fick ett bra svar så jag kunde börja med init.php sidkontrollern och första metoden i CContent. 
    Jag tyckte fortfarande att det var svårt och läste om att blog och page skulle använda CContent i den blå rutan men efter en till fråga och svar på forumet så 
    insåg jag att det var främst edit.php som skulle använda klassen. Så då var det bara att jobba på. Jag valde att göra extrauppgiften med userkopplingen.</p>
<p>Jag fick ett problem med EOD. Det har varit struligt tidigare men nu fungerade det inte alls när jag ville ha SQL satserna i initieringsfilen som EOD. Det visade 
sig när jag sökt på nätet att NetBeans som jag använder har en bugg för just EOD. Så jag löste det istället med vanliga ””. Tyvärr så medförde det att jag måste använda ’ ’ 
för datat istället för ” ” ,som Mikael hade gjort, i initieringsskriptet så /n kom inte med i texten Jag tror det berodde på det iallafall. Men när man uppdaterar via edit 
sidan går det att använda /n precis som det är tänkt! . Jag är riktigt nöjd med NetBeans förövrigt så jag fortsätter att använda den som IDE, synd bara att man behöver använda 
EOD så ofta med detta sätt att lägga upp sidkontrollerna.</p>
<h3>CTextFilter</h3> 
<p>Jag gjorde det mesta av konverteringen av filter.php till CTextFilter på egen hand men stötte på ett problem med nl2br som är en funktion i PHP och inte ligger som en metod i 
filterklassen. Jag tyckte att jag redan nu ställt så mycket frågor i forumet så jag provade en annan taktik. Jag tittade snabbt igenom emil.e.johanssons källkod för CTextFilter 
och använde mig av hans lösning på problemet. Jag tycker att den var snygg. </p>
<h3>CBlog och CPage</h3>
<p>Jag fick ett svar även om dessa klasser i forumet. Vi hade valmöjllighet hur vi ville koppla klasserna till CContent. Jag beslutade mig för att låta CPage och CBlog ärva CContent. 
Tyvärr innehåller inte vare sig CBlog eller CPage särskilt mycket kod med min lösning. Jag ser inte hur jag skall flytta över mer kod till CBlog eftersom det är en loop där i sidkontrollern 
som går igenom alla bloggarna. När jag gjorde CBlog uppdaterade jag även CUser med en metod för att hämta namnet om man hade acronymet. </p>
<h3>Allmänt</h3>
<p>Mina sidor validerar inte riktigt men det gör inte Mikaels heller så jag låter det vara tills vidare. Jag har inte heller hunnit med att kommenterat alla nya klasser och metoder men planerar
att göra det till projektet.  Momentet har ändå tagit mycket tid redan som det är. Jag tycker om att det är många moduler i EMBLA. Det känns som man har åstadkommit något även om det inte är så 
mycket jag har gjort själv förstås. Jag kan inte komma på några moduler som jag saknar just nu men det beror förstås vad man skall använda EMBLA till. Det skall bli spännande att börja med 
bildbearbetningsmodulen nu.</p>
</article>
<hr class='dotted'>
     <article class ='col2'>
    <h2>Kmom04: PHP PDO och MySQL</h2>
    <h3>Litteraturen</h3>
    <p>Jag tyckte att jag fick en bra översikt över olika webbaserade tekniker i Databasteknikboken. I huvudboken hade jag redan läst PDO kapitlet
    i förra kursen så jag bläddrade bara igenom det. Kapitel 30 läste jag däremot relativt noggrant.</p>
<h3>Skapa en klass för din databashantering, CDatabase</h3> 
<p>Jag använde kursens klass för databashantering rakt av. </p>
<h3>Generera en HTML-tabell från en databastabell, använd sökning, sortering och paginering 
och skapa en klass för användarhantering, CUser</h3>
<p>Jag började glatt med att försöka själv. Men det blev väldigt komplicerade if satser så jag tittade på Mikaels källkod. Mycket snyggare löst där.
Jag fortsatte jobba själv men fick många felmeddelande som jag inte kunde lösa och tiden rann iväg. Till slut så kopierade jag hela Mikaels källkod men
tog bort genresökningen.  Jag funderade på hur man skulle få till en klass där man bara skickade in en databas och får ut en htmlsträng. Jag provade 
en del men jag kom inte på något sätt då man behöver så mycket indata från pagecontrollern. Så till en början nöjde jag mig med att flytta funktioner som 
anropas till en egen klass. Därefter började jag med CUser. Här var det mycket mindre kod och kändes mycket mer överskådligt. Delmomentet var roligt och jag
kom pga ett fel jag gjorde på att <code>POST</code> var nåbar även i klassen inte bara i pagecontrollern som jag trott tidigare. När jag var färdig med denna klass tittade
jag därför på min pagecontroller movie och klass CMovie igen. Även <code>GET</code> visade sig också vara åtkomlig i klassen så jag flyttade över rätt mycket mer kod dit 
från pagecontrollern. Jag hade jobbat lokalt och skulle nu flytta över till BTH. Då upptäckte jag bland annat att movie gav många valideringsfel när man gjort
ett val och sökt. Men eftersom Mikael har samma typ av fel lämnar jag in ändå. </p>
<p><i>Nu har jag korrigerat sidan så att valideringsfelen är borta. Jag fick hjälp på forumet. Det gällde att lägga till htmlentities på rätt ställe.</i></p>
<h3>PDO, Guide filmdatabas, Klasser</h3>
<p>Det känns bra att jobba med PDO. Jag gjorde början av guiden och läste allt noggrant. Klasser fungerar bra ur återanvändningssynpunkt. Tex CDatabase har nu 
använts på flera ställen. Jag tycker att fördelen känns större i CUser med en relativt enkel klass än med CMovie där det tog rätt lång tid att flytta över koden
men nu när den väl är överflyttad kanske man kan återanvända iallafall en del av metoderna medan andra känns rätt specifika för just den här pagecontrollern. <i>När 
jag tänkte över min reflektion kom jag på att man kunde göra en bättre CMovies. Jag har nu gjort en basklass där de återanvändbara metoderna ligger och en ärvd 
klass där de specifika ligger.</i></p>
</article>
<hr class='dotted'>
    <article class ='col2'>
    <h2>Kmom03: SQL och databasen MySQL</h2>
    <h3>Bakgrundskunskaper i Databaser och SQL</h3>
    <p>Jag har läst Databasmetodik där SQL ingick på Stockholms universitet våren 2010. 
    Sedan dess har jag använt databaser tillsammans med flera olika programmeringsspråk. 
    Jag har använt databaserna Microsoft Access, Microsoft SQL Express och MySQL samt nu i senaste kursen SQLite.
</p>
    <h3>Litteraturen</h3>
    <p>Jag har alla tre böckerna men hann inte läsa allt på den avsatta tiden så jag koncentrerade mig på huvudboken 
    och läste även databaskapitlet i ”Webbutveckling med PHP och MySQL”</p>
<h3>Klienterna</h3> 
<p>Det var roligt att testa alla tre klienterna. Jag föredrog helt klart de med GUI. Allra bäst tyckte jag om Workbench.  
Det märktes peciellt i övningarna eftersom man så smidigt kunde spara undan SQL frågor och exekvera dem alla på en gång
eller enskilt. Jag provade både phpMyAdmin och Workbench i övningarna eftersom jag hade problem med Workbench periodvis. 
Det tog lång tid och ett svar på forumet för att få till SSH tunneln till BTH men nu när den fungerar planerar jag att använda den i kursen. </p>
<h3>Övningarna</h3>
<p>Jag gjorde övningarna lokalt och kände igen i princip allt från databasmetodik-kursen jag gått.  Men eftersom det inte finns någon uppgift till 
det här momentet så gick jag igenom alla. Det var en bra repetition och en del klurigheter. Åldern löste jag till exempel inte alls som mos. </p>
<h3>Tidsåtgången</h3>
<p>Tyvärr tog momentet lite mer än 20 timmar för mig. Men om SSH tunnelproblemet inte hade uppstått så hade det nog varit lagom med tid.</p>
</article>
<hr class='dotted'>
<article class ='col2'>
    <h2>Kmom02: Objektorienterad programmering i PHP</h2>
    <h3>Bakgrundskunskaper i OOP</h3>
    <p>Jag har läst en en kurs i objekorienterad modellering med UML och en kurs i objektorienterad programmering
    med java. I de kurser jag har läst i .NET har också objektorientering varit centralt så jag har rätt
    mycket bakgrundskunskaper.</p> 
    <h3>Litteraturen</h3>
    <p>Jag läste första kapitlet ”Chapter 6: Object-Oriented PHP” noggrant men sen var jag så sugen på att programmera 
    så jag satte igång med uppgiften. Efter det att jag var färdig med den läste jag de återstående tre kapitlen. Det jag efter
    genomläsningen saknar i PHP är överlagrade metoder, men det finns ju i alla fall överlagrade konstruktorer. När det
    gäller felhanteringen funderade jag på var det vore lämpligast att placera logfilen, inte i webbroten står det. Innebär 
    det att den skall placeras utanför www eller utanför embla webroot? Jag kanske ställer en fråga om det i forumet. 
    Intressant att man kunde fånga två exceptions samtidigt det känner jag inte igen från tidigare. Läsningen tog sammanlagt
    ungefär de 6 timmar som rekommenderades som max.</p>
<h3>Guiden</h3> 
<p>Jag läste grundligt igenom guiden och gjorde en del av övningarna.</p>
<h3>Tärningspelet 100</h3>
<p>Det var lite klurigt att lista ut hur spelet fungerade men jag tror att jag lyckades till slut. Jag använde mig av en spelomgångsklass 
där data om spelomgången sparades och där det finns metoder för att hämta datat och bearbeta det. Jag har tidigare programmerat ett spel och
tycker att det upplägget känns logiskt.  Förutom den klassen använde jag mig av kursens tärningsklass och den ärvda tärningsbildsklassen. 
Logiken för spelet la jag direkt i pagecontrollern. Jag hade problem med att få upp tärningsbilden först men efter lite felsökande löste jag det.
Sen var det många gånger jag försökte anropa metoder med ett . istället för ett -> av gammal vana. Jag gjorde inte några av extrauppgifterna eftersom 
jag ändå lade ner ca 20 timmar på momentet.</p>
</article>
<hr class='dotted'>
<article class ='col2'>
   <h2>Kmom01: Kom igång med programmering i PHP</h2>  
<h3> Utvecklingsmiljö</h3>
<p>Jag använder operativsystem: Windows 7, filöverföringsprogram: FileZilla, IDE:  NetBeans. 
    Vid några enstaka tillfällen använder jag också mig av editor: JEdit. </p>
<h3>Litteraturen</h3>
<p>Jag har precis i förra kursen läst de kapitel som rekommenderades i ” Beginning PHP and MySQL” 
    så jag läste inte om dem. Däremot lästa jag det första kapitlet i de två andra böckerna. 
    Det jag reflekterade över är dels hur många olika betydelser det finns på benämningen databaser, 
    och dels att intendering skall användas även i PHP. Jag var slarvig med det i förra kursen. 
    Jag läste även något som var nytt för mig att det är god kutym att använda måsvingar 
    efter if satser även om de bara är på en rad. Jag skall försöka tänka på det.</p>
<h3>Guiden</h3> 
<p>Jag gick igenom guiden men kommer inte just nu på något speciellt som var nytt för mig. 
    Det var ju nyss jag gick igenom en liknande guide i htmlphp kursen. </p>
<h3>Webbmall</h3>
<p>Jag döpte webbmallen EMBLA till Embla den första kvinnan i nordiska mytologin. 
    Jag gjorde inga förändringar utan lät mallen vara kvar som den är. </p>
<h3>Source</h3>
<p>Jag gjorde enligt en av beskrivningarna source som en modul i Embla. Det gick rätt smidigt.</p>
<h3>Dynamisk navbar</h3>
<p>Det som var svårast var den dynamiska navbaren. Jag försökte först göra varianten med callback men
    misslyckades så istället valde jag den enklare varianten.</p>
<h3>Git</h3>
<p>Jag gjorde inte extrauppgiften dels för att det inte är del av examinationen och dels för att jag inte
    inte ville lägga filerna på GitHub. Men det söks ofta efter folk som kan Git så jag borde lära mig.</p>
 </article>";

 

 
// Finally, leave it all to the rendering phase of Embla.
include(EMBLA_THEME_PATH);
