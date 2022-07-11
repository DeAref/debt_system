<div dir='rtl' align='right'>
  
<h1>فهرست</h1>
<ul>
  <li> <a href="#howtoinstall">نحوه نصب</a>
    <ul>
      <li>ساختن پایگاه داده </li>
      <li>وارد کردن پایگاه داده</li>
      <li>اتصال پایگاه داده </li>
    </ul>  
  </li>
  <li> <a href="howtoinstall">test</a></li>
 <li> <a href="howtoinstall">test</a></li>
</ul>


<h1 id="howtoinstall">نحوه نصب</h1>
<p>
  <strong> 
    روش اول:
  </strong><br>
  ابتدا یک فورک از ریپازیتوری بگیرید
  برای اینکار کامند های زیر را در cmd وارد کنید
  
  </p>
<script src="https://gist.github.com/DeAref/e3344779f3566be03bd3e04b82fc5fee.js"></script>
          <br>
<strong> 
  روش دوم: 
   </strong>
  <p>
  به صورت دستی فورک کنید و سپس فایل را دانلود کنید
  </p>
  <br>
    
 <img src="https://user-images.githubusercontent.com/95649368/178138292-91d0bcbb-bde2-4818-89f3-5d520c6323d6.png" width="500px"/>
 
  <br>
    
  <h3>ساخت پایگاه داده</h3>
<p>
   
 برای ساخت پایگاه داده ، وارد phpmyadmin شوید. سپس کوری زیر را اجرا کنید
   
</p>
    
  <br>
 <script src="https://gist.github.com/DeAref/522a1ebde9c0586c0c774a4ee0b39d3a.js"></script>
    <h3>
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
    
  <h3>
  اتصال پایگاه داده
 
  </h3>
    <p>
      فایل library/config.php را باز کنید.
      
      <br>
      <script src="https://gist.github.com/DeAref/ed65d803474924228d5c6d2f3b3835bc.js"></script>
      خط 4 و 16 و 17 را ادیت کنید.
      
      سپس فایل admin/config.php را باز کنید 
      <script src="https://gist.github.com/DeAref/af1749cfca3b28c2711b57798a81a3da.js"></script>
      <br>
      و خط 3 و 4 و 5 و 19 را ادیت کنید.
      
  </p>
    <p>
      در نهایت فایل .htaccess را ادیت کنید و آدرس دامین خودتون رو بزارید تا صفحه 404 رو بتونه پیدا کنه.
      
      <br>
      <strong> تمام. حالا سامانه راه اندازی شد </strong>
  </p>
  <h1>ساختار برنامه</h1>
  <h3> نقشه سایت</h3>
  <p>
    
  این برنامه از دو بخش تشکیل شده است ، بخش Client , بخش Admin همانطور که از نامشان پیداست ، کد های پنل ادمین از کد های پنل کاربر جدا هستند.
   

  
  </p>
  <img src="https://user-images.githubusercontent.com/95649368/178249509-41e2a794-7b61-43b4-a5ca-44f68a6014e9.png" href="https://www.gloomaps.com/oDQRcmpHlY"/>



</div>
