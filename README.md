# debt_system
Debt System | Create an account, get a Debt, pay the installments. Or give Debt, have statistics and manage users

<div dir='rtl' align='right'>
<h1>سامانه دریافت وام</h1>
<h1>فهرست</h1>
<ul>
<li><a href="#howtoinstall">نحوه نصب</a>
<ul>
<li><a href="#way1"> روش دوم </a></li>
<li><a href="#way2"> روش اول </a></li>
<li><a href="#createDB"> ساختن پایگاه داده </a></li>
<li><a href="#1"> وارد کردن پایگاه داده</a></li>
<li><a href="#2"> اتصال پایگاه داده </a></li>
</ul>
</li>
<li><a href="#3">ساختار برنامه</a>
<ul>
<li><a href="#4"> نقشه سایت </a></li>
<li><a href="#5"> ساختار پایگاه داده </a></li>
<li><a href="#6"> ساختار کد ها </a></li>
<li><a href="#7">پوشه dist</a></li>
<li><a href="#8">پوشه library </a></li>
<li><a href="#9">پوشه plugins </a></li>
<li><a href="#10">پوشه uploads</a></li>
<li><a href="#11">پوشه idea </a></li>
</ul>
</li>
<li><a href="#12">کتابخونه ها </a>
<ul>
<li><a href="#13"> فایل Config.php </a></li>
<li><a href="#14"> فایل header.php </a></li>
<li><a href="#15"> فایل footer.php</a></li>
<li><a href="#16">فایل register.php </a></li>
<li><a href="#17">فایل resource_usage.php </a></li>
<li><a href="#18">فایل dateTime.php </a>
<ul>
<li><a href="#19"> تابع differenceDate</a></li>
</ul>
</li>
<li><a href="#20">فایل rndStr.php</a></li>
<li><a href="#21">فایل tax.php </a></li>
</ul>
</li>
</ul>


<h1 id="howtoinstall">نحوه نصب</h1>

  <h3 id="way1"> 
    روش اول:
  </h3>
<p>
<br>
  ابتدا یک فورک از ریپازیتوری بگیرید
  برای اینکار کامند های زیر را در cmd وارد کنید
</p>
  <pre>cd c://wamp64/www
git clone https://github.com/DeAref/debt_system.git</pre>
<br>
 <h3 id="way2"> 
    روش دوم:
  </h3>
<p>
  به صورت دستی فورک کنید و سپس فایل را دانلود کنید
  </p>
  <br>
    
 <img src="https://user-images.githubusercontent.com/95649368/178138292-91d0bcbb-bde2-4818-89f3-5d520c6323d6.png" width="500px"/>
 
  <br>
  <h3 id="createDb">ساخت پایگاه داده</h3>
<p>
   
 برای ساخت پایگاه داده ، وارد phpmyadmin شوید. سپس کوری زیر را اجرا کنید
   
</p>
    
  <br>
  <pre>CREATE DATABASE debt CHARACTER SET utf8 COLLATE utf8_general_ci</pre>
 <h3 id="1">
    وارد کرده پایگاه داده
 </h3>
  
<p>
  
  فایل دیتا بیس را دانلود کرده و سپس در phpMyadmin ایمپورت کنید 
  لینک فایل دیتابیس: 
  <br>
  <a href="https://github.com/DeAref/debt_system/blob/main/database/debt.sql">
  https://github.com/DeAref/debt_system/blob/main/database/debt.sql
  </a>
  
  </p>
    
  <h3 id="2">
  اتصال پایگاه داده
 
  </h3>
  <p>
      فایل library/config.php را باز کنید.
      
  <br>
  <pre dir="ltr">

//..................... localhost...username...password.....database name.....//
$conn = mysqli_connect("localhost", "root", "", "debt");
//mysql_set_charset('utf8', $conn);
// mysqli_query($conn, "SET NAMES utf8");
// mysqli_query($conn, "SET CHARACTER SET utf8");
//mysqli_query($conn, "SET character_set_connection = utf8");
$sumDeptValue = 0;
$sumPayed = 0;
$sumMonthCount = 0;
$sumUnPayed= 0 ;
$systemDate = date('y-m-d');
$systemTime = date('h:i:s');
$systemDateTime = date('y-m-d | h:i:s');
$loginAddress = "http://5ip.ir/debt/client/login.php";
$Domain= "http://5ip.ir";</pre>
      خط 4 و 16 و 17 را ادیت کنید.
  <br>
      
      سپس فایل admin/config.php را باز کنید 
  <pre dir="ltr" align="right">
$host = "localhost";
$usernameDBmySql = "debt";
$passwordDBmySql = "";
$databaseNameMysql = "debt";
//.............................. localhost...username.......password..............database name.....//
$conn = mysqli_connect($host, $usernameDBmySql, $passwordDBmySql,$databaseNameMysql);

//mysqli_set_charset($conn,'utf8');
// mysqli_query($conn, "SET NAMES utf8");
// mysqli_query($conn, "SET CHARACTER SET utf8");
//mysqli_query($conn, "SET character_set_connection = utf8");
$sumDeptValue = 0;
$sumPayed = 0;
$sumMonthCount = 0;
$sumUnPayed= 0 ;
$systemDate = date('y-m-d');
$systemTime = date('h:i:s');
$loginAddress = "http://localhost/dept/client/login.php";
</pre>
  <br>
      و خط 3 و 4 و 5 و 19 را ادیت کنید.
      
  </p>
  <p>
      در نهایت فایل .htaccess را ادیت کنید و آدرس دامین خودتون رو بزارید تا صفحه 404 رو بتونه پیدا کنه.
      
  <br>
  <strong> تمام. حالا سامانه راه اندازی شد </strong>
  </p>
  <h1 id="3">ساختار برنامه</h1>
  <h3 id="4"> نقشه سایت</h3>
  <p>
    
  این برنامه از دو بخش تشکیل شده است ، بخش Client , بخش Admin همانطور که از نامشان پیداست ، کد های پنل ادمین از کد های پنل کاربر جدا هستند.
   

  
  </p>
  <img src="https://user-images.githubusercontent.com/95649368/178249509-41e2a794-7b61-43b4-a5ca-44f68a6014e9.png" href="https://www.gloomaps.com/oDQRcmpHlY"/>
  <h3 id="5">ساختار پایگاه داده</h3>
  <p> 
  دیتابیس از 6 جدول تشکیل شده که در پایین میتونید ساختار بصری اون رو ببینید
    
  </p>
   <img src="https://user-images.githubusercontent.com/95649368/178250730-14cc9b92-9841-4676-b9fe-e38f2402940b.png" href="https://www.gloomaps.com/oDQRcmpHlY"/>
  <h3 id="6">ساختار کد ها</h3>
<p>
  
  دوتا فایل کانفیگ داریم ، یکی در پوشه admin و دیگری در پوشه library . هرچی تو library هست برای سمت کلاینته و برای ادمین جداگونه در پوشه admin کد زده شده.
  هدر و فوتر قسمت کلاینت در پوشه Library قرار داره و از ایندکس جدا هست ، برای اتصال هم توی فایل هایی که بهش نیاز داریم باید با دستور include فراخونی کنیم.
  <br>
  در قسمت ادمین نیز هدر و فوتر جدا هست با این تفاوت که هدر و فوتر در پوشه admin کنار index قرار دارد.
  </p>
  <h4 id="7">پوشه dist</h4>
  <p>
  این پوشه فایل های css - js فونت ها و تصاویر رو در برگرفته
  </p>
  
  <h4 id="8">پوشه library</h4>
  <p>
  این پوشه حاوی کتابخونه هایی هست که در برنامه استفاده شده ، همینطور فایل های هدر و فوتر و ثبت نام در اینمجا قرار دارد
  </p>
  
  <h4 id="9">پوشه plugins</h4>
  <p>
  این پوشه حاوی کتابخونه های css,js هست که توی UI برنامه استفاده میشه(این کتابخونه ها همشون استفاده نشدن و بعضی هاشون که نیاز بود در پروژه استفاده شدن)
  </p>
  
  <h4 id="10">پوشه uploads</h4>
  <p>
  عکس پروفایل هایی که توسط کاربران و مدیران اپلود میشوند در این پوشه قرار میگیرد 
  </p>
  
  <h4 id="11">پوشه idea</h4>
  <p>
    این پوشه توسط برنامه phpStorm موقع کد زدن ایجاد شده ، فایل های کمکی برای خودش هست و با ما کاری نداره.
  </p>
  
  <h1 id="12">
    کتابخونه ها
    </h1>
      
<h4 id="13">
      فایل Config.php  
</h4>
<p>
این فایل حاوی اطلاعاتی هست که در برنامه بار ها و بار ها تکرار میشن از جمله اطلاعات دیتابیس    
</p>
<h4 id="14">
فایل header.php  
</h4>
<p>
این فایل هدر سایت ما هستنش و اصلا نمیشه بهش گفت کتابخونه ولی خوب من گذاشتمش اینجا. اتصال به سی اس اس ها اینجا انجام میشه     
</p>
  
  <h4 id="15">
فایل footer.php  
</h4>
<p>
اینم فوتر سایت هست و اتصال به جی اس ها اینجا انجام میشه ، البته بعضی هاشون هم تو هدر اتصال دادیم     
</p>
<h4 id="16">
فایل register.php  
</h4>
<p>
این فایل کد های php مربوط به ثبت نام رو توی خودش جای داده ، کد های html مربوط به ثبت نام هم در مسیر client/register.php هستند.     
</p>
  
<h4 id="17">
فایل resource_usage.php  
</h4>
<p>
این فایل مقدار استفاده از رم را محاسبه میکند و در پنل مدیریت قسمت داشبورد ازش استفاده شده. 
  <br>
  در خط 104 میتونید نحوه نمایش رو تغییر بدید
  <br>
  
 خط 112 به پایین هم پسوند متن رو معلوم و ذخیره میکنه (kB - GB - TB - B)
  <pre dir="ltr"> function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}</pre>
</p>
<h4 id="18">
فایل dateTime.php  
</h4>
<p>
توی این فایل توابعی رو نوشتم که میتونن تاریخ رو بگیرن و یک روز/ماه/سال عقب جلو کنن
  <br>
  مثال استفاده :
 <pre dir="ltr">echo pre2Day("2022-02-10");</pre>
</p>
<h5 id="19">
  تابع differenceDate
</h5>
<p>
  این تابع تفاوت بین تاریخی که بهش میدید و تاریخی که الان توش قرار داریم رو محاسبه میکنه و خروجی میده 
  <pre dir="ltr">differenceDate($now,$yourDate);</pre>
</p>

<h4 id="20">
فایل rndStr.php  
</h4>
<p>
این فایل حاوی یک تابع برای ساخت رشته رندوم هست  
  <br>
  فقط کافیه randomString رو صدا بزنید تا یک رشته حاوی اعداد 0 تا 9 و حروف بزرگ و کوچک انگلیسی تحویل بگیرید(از این تابع برای نامگذاری فایل ها میخواستم استفاده کنم)
  </p>
  
<h4 id="21">
فایل tax.php  
</h4>
<p>
اینجا مالیات رو محاسبه میکنیم ، این تابع دوتا ورودی داره یکی درصد مالیات رو میگیره برای مثال 0.9درصد و دیگری مبلغ رو میگیره و در خروجی مبلغ به اضافه مالیات رو بر میگردونه.
  <br>
<pre dir="ltr">
tax($Percent,$Value);
</pre>
</p>
<hr>
<h2 dir="ltr" class="button"><a href="https://5ip.ir/debt">Live Demo</a></h2>
<table dir="ltr">
  <thead>
    <tr>
       <th style="text-align: left">role</th>
      <th style="text-align: left">username</th>
      <th style="text-align: left">password</th>
     
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: left">user</td>
      <td style="text-align: left">52503346</td>
      <td style="text-align: left">1234</td>
    </tr>
    <tr>
      <td style="text-align: left">admin</td>
      <td style="text-align: left">aref</td>
      <td style="text-align: left">2022</td>
    </tr>
    
  </tbody>
</table>
</div>

<hr>
<h1 align="left">Contact me</h1>
<h4 align="left"><a href="https://t.me/DeAref">Telegram</a></h4>
<h4 align="left"><a href="https://t.me/ProgrammingEngineer1">Telegram Channel</a></h4>
<h4 align="left"><a href="mailto://aref@post.ir">Email</a></h4>
<h4 align="left"><a href="https://t.me/AppDuny">AppDuny</a></h4>
