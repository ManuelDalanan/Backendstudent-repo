<h1>Library Information Management System</h1>

<h5>Notes: </h5>
<ul>
    <li>Create .env to connect</li>
    <li>Migrate first before proceeding</li>
    <li>You can use seeders to use test data. Current available factory and seeders: users, departments, books, periodicals, articles, and projects</li>
    <li>Database structure is bound to change without further notice, kindly update version whenever possible</li>
    <li>Consult first before altering database structure</li>
    <li>Roles: superadmin, admin, staff, user</li>
</ul>
<h2>Routes</h2>
<em>Default URL: localhost:8000/api</em><br>
<em>Default return type is in json format</em>

<h3>Logging in and Logging out</h3>
<em>Note: Save the auth token to a secured place and check AuthController</em>
<ol>
    <li>/login/{subsystem}</li>
    <li>/logout</li>
</ol>

<h3>All Materials - get (all users): </h3>
<ol>
    <li>/books</li>
    <li>/periodicals</li>
    <li>/articles</li>
    <li>/projects</li>
</ol>

<h3>Single Material - get (all users) #not recommended: </h3>
<ol>    
    <li>/book/id/{int:id}</li>
    <li>/periodical/id/{int:id}</li>
    <li>/article/id/{int:id}</li>
    <li>/project/id/{int:id}</li>
</ol>

<h3>Single Material Image - get (all users) # recommended to get per click of record: </h3>
<ol>    
    <li>/book/image/{int:id}</li>
    <li>/periodical/image/{int:id}</li>
    <li>/project/image/{int:id}</li>
</ol>

<h3>Periodicals and Projects according to type - get (all users): </h3>
<ol>
    <li>/periodicals/type/{string:type}</li>
    <li>/projects/type/{string:type}</li>
</ol>

<hr>
<!-- <em><strong>Fillables</strong></em>
<pre>
    <em><b>Books:</b>
            'id', 'call_number': str, 'title': str, 'author': str, 'image_location': str, 'language': str,
            'location_id': int, 'publisher': str, 'copyright': year, 'volume': int(nullable), 'edition': str(nullable), 
            'pages': int, 'content': text(nullable), 'remarks': text(nullable), 'date_published': date
    </em>
</pre><br>

<pre>
    <em><b>Periodicals:</b>
            'id', 'material_type': str, 'title': str, 'author': str, 'image_location': str, 'language': str,
            'publisher': str, 'copyright': year, 'volume': int(nullable), 'issue': int(nullable), 
            'pages': int, 'content': text(nullable), 'remarks': text(nullable), 'date_published': date            
    </em>
</pre><br>

<pre>
    <em><b>Articles:</b>
            'title': str, 'author': str, 'language': str, 'subject': str, 'date_published': date,
            'volume': int(nullable), 'issue': int(nullable), 'page': int, 'abstract': str, 'remarks': str(nullable)
    </em>
</pre><br>

<pre>
    <em><b>Projects:</b>
            'id', 'type': str, 'title': str, 'author': str, 'course_id': int(FK), 'image_location': str, 
            'date_published': date, 'language': str, abstract': str
    </em>
</pre><br> -->

<h3>Adding Materials (POST): </h3>
<em>Note: Include copies; include the original in the copy count</em>
<ol>    
    <li>/books/process</li>
    <li>/periodicals/process</li>
    <li>/articles/process</li>
    <li>/projects/process</li>
</ol>

<h3>Updating Materials (POST): </h3>
<em>Note: Add '_method' to payload with value 'PUT'</em>
<ol>    
    <li>/books/process/{id}</li>
    <li>/periodicals/process/{id}</li>
    <li>/articles/process/{id}</li>
    <li>/projects/process/{id}</li>
</ol>

<h3>Delete Materials (DELETE): </h3>
<ol>    
    <li>/books/process/{id}</li>
    <li>/periodicals/process/{id}</li>
    <li>/articles/process/{id}</li>
    <li>/projects/process/{id}</li>
</ol>
