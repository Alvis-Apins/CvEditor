<h1>
    CV Editor
</h1>

<p>
Info:
</p>
<pre>
Web application lets you create your CV (Add, Edit, Delete Information and Print CV)
</pre>
<pre>
Required Tools:
1. Symfony 6 + CLI installed (<a href="https://symfony.com/download"> ClI instalation </a>)
2. PHP 8.1
3. PostgreSQL - 14.5
</pre>

<p>
Setup:
</p>
after cloning project locally
<ul>
<li>create .env file and add info like in .env.example</li>
<li>in .env file configure connection to PostgreSQL database</li>
</ul>
<pre>
<b>composer install</b>
</pre>
<pre>
<b>npm install</b>
</pre>
<pre>
npm run dev
</pre>

Next commands needs Symfony-CLI installed
<pre>
symfony console doctrine:database:create
</pre>
<pre>
symfony console doctrine:migrations:migrate
</pre>
<pre>
symfony server:start -d
</pre>

<h2> The aplication is set up and ready to go - click on the localhost address that is provided in terminal </h2>

![Screenshot from 2022-10-03 00-17-49](https://user-images.githubusercontent.com/104777801/193477112-02d7c276-20af-4faa-b5b5-94fcf67dfc4b.png)
---
![Screenshot from 2022-10-03 00-17-58](https://user-images.githubusercontent.com/104777801/193477118-86c0163a-ed29-4482-8094-5ff38c77b181.png)
---
![Screenshot from 2022-10-03 00-18-37](https://user-images.githubusercontent.com/104777801/193477125-edbdbe17-38b0-4ad4-a060-eef0934e556a.png)
---
![Screenshot from 2022-10-03 00-18-48](https://user-images.githubusercontent.com/104777801/193477131-dcc98d38-8a75-45ad-af3a-7c5b75648376.png)





