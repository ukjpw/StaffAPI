<!DOCTYPE html>
<head>

    <style>
          
        body {
        font-family: Arial, Helvetica, sans-serif;
        }

        h2 {
           margin-top: 1.3rem     
        }

        table {
          
          border-collapse: collapse;
          width: 90%;
        }
        
        td, th {
          border: 1px solid #ddd;
          padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2;}

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4134f0;
            color: white;
        }


        .staff_id_url_segment {
            font-weight: bold;
            color: green;
        }

        caption {
            text-align: left;
            font-weight: bold;
            padding-bottom: 0.8rem;
        }

      </style>  
</head>
<body>
<h1>StaffAPI</h1>

<h2>Overview</h2>
<p>StaffAPI web is a RESTful API built using  Laravel Framework 9.19.  The API allows users to:</p>
<ul>
    <li><a href="#endpoint_create_rec">Create a staff record</a></li>
    <li><a href="#endpoint_update_rec">Update a staff record</a></li>
    <li><a href="#endpoint_delete_rec">Delete a staff record</a></li>
    <li><a href="#endpoint_view_rec">View a staff record</a></li>
    <li><a href="#endpoint_list_all">List all staff records</a></li>
</ul>

<h2>Setting up StaffAPI in your Local Environment</h2>
<p>After checking out the main branch. Please follow the below instructions:</p> 
<ol>
    <li>Ensure your environment is setup to run Laravel with MySQL.    
        Please see <a href="https://laravel.com/docs/9.x/installation">https://laravel.com/docs/9.x/installation</a></li>
    <li>Create a MySQL database called <b>staffapi</b> (it can be a different name, as long as the <b>DB_DATABASE</b> in the <b>.env</b> file matches), </li>
    <li>Run <code>php artisan migrate</code> to create the staff table</li>
    <li>Run <code>php artisan db:seed</code> to seed the staff table with sample data</li>
    
</ol>


<h2>API Endpoints</h2>
<h3><a name="endpoint_create_rec">Create a Staff Record</a></h3>
<p>
<b>URL:</b> http://localhost/api/staff<br/>
<b>Method:</b> POST<br/>
<b>Content-Type:</b> application/json<br/>


<table class="json_vars">
    <caption>
        API Request JSON fields
    </caption>
    <thead>
        <tr>
            <th>Name</th>
            <th>Data Type</th>
            <th>Max Length</th>
            <th>Range of Values</th>
            <th>Required?</th>

        </tr>       
    </thead>
    <tbody>
        <tr>
            <td>email</td>
            <td>string - valid email</td>
            <td>255</td>
            <td>-</td>
            <td>Yes</td>
            
        </tr>
        <tr>
            <td>password</td>
            <td>string</td>
            <td>255</td>
            <td>-</td>
            <td>Yes</td>
        </tr>
        <tr>
            <td>first_name</td>
            <td>string</td>
            <td>255</td>
            <td>-</td>
            <td>Yes</td>
            
        </tr>
        <tr>
            <td>last_name</td>
            <td>string</td>
            <td>255</td>
            <td>-</td>
            <td>Yes</td>
            
        </tr>
        <tr>
            <td>status</td>
            <td>string</td>
            <td>255</td>
            <td>Active, Inactive</td>
            <td>Yes</td>            
        </tr>
        <tr>
            <td>squad</td>
            <td>string</td>
            <td>255</td>
            <td>squad1, squad2, squad3, squad4, squad5, NA</td>
            <td>Yes</td>            
        </tr>
        <tr>
            <td>start_date</td>
            <td>ISO 8601 (YYYY-mm-dd)</td>
            <td>-</td>
            <td></td>
            <td>Yes</td>            
        </tr>
        <tr>
            <td>notes</td>
            <td>string</td>
            <td>1000</td>
            <td>-</td>
            <td>No</td>
        </tr>
    </tbody>
</table>
<br/>
<table class="">
    <caption>
    API Response Details
    </caption>
    <thead>
        <tr>
            <th>Status</th>
            <th>Description</th>
            <th>Response Code</th>
            <th>Response Body</th>            
        </tr>       
    </thead>
    <tbody>
        <tr>
            <td>Success</td>
            <td>Staff record created successfully</td>
            <td>201</td>
            <td><code>
                {
                    "status": "success",
                    "message": "staff record created successfully"
                }
            </code></td>
        </tr>
        <tr>
            <td>Error</td>
            <td>Missing or invalid request fields</td>
            <td>400</td>
            <td><code>
                {
                    "status": "error",
                    "message": [
                        "The email field is required.",
                        "The last name field is required."
                    ]
                }
            </code></td>
        </tr>    
        <tr>
            <td>Error</td>
            <td>Email already exists</td>
            <td>400</td>
            <td><code>
                {
                    "status": "error",
                    "message": "email already exists"
                }
            </code></td>
        </tr>
    </tbody>
</table>

<h3><a name="endpoint_update_rec">Update a Staff Record</a></h3>
<p>
<b>URL:</b> http://localhost/api/staff/<span class="staff_id_url_segment">{staffid}</span><br/>
<b>Method:</b> PUT<br/>
<b>Content-Type:</b> application/json
</p>

<table class="json_vars">
    <thead>
        <caption>
            API Request JSON fields 
         </caption>   
        <tr>
            <th>Name</th>
            <th>Data Type</th>
            <th>Max Length</th>
            <th>Range of Values</th>
            <th>Required?</th>

        </tr>       
    </thead>
    <tbody>
        <tr>
            <td>email</td>
            <td>string - valid email</td>
            <td>255</td>
            <td>-</td>
            <td>No</td>
            
        </tr>
        <tr>
            <td>password</td>
            <td>string</td>
            <td>255</td>
            <td>-</td>
            <td>No</td>
        </tr>
        <tr>
            <td>first_name</td>
            <td>string</td>
            <td>255</td>
            <td>-</td>
            <td>No</td>
            
        </tr>
        <tr>
            <td>last_name</td>
            <td>string</td>
            <td>255</td>
            <td>-</td>
            <td>No</td>
            
        </tr>
        <tr>
            <td>status</td>
            <td>string</td>
            <td>255</td>
            <td>Active, Inactive</td>
            <td>No</td>            
        </tr>
        <tr>
            <td>squad</td>
            <td>string</td>
            <td>255</td>
            <td>squad1, squad2, squad3, squad4, squad5, NA</td>
            <td>No</td>            
        </tr>
        <tr>
            <td>start_date</td>
            <td>ISO 8601 (YYYY-mm-dd)</td>
            <td>-</td>
            <td></td>
            <td>No</td>            
        </tr>
        <tr>
            <td>notes</td>
            <td>string</td>
            <td>1000</td>
            <td>-</td>
            <td>No</td>
        </tr>
    </tbody>
</table>
<br/>
<table class="">
    <caption>
        API Response Details
        </caption>
    <thead>
        <tr>
            <th>Status</th>
            <th>Description</th>
            <th>Response Code</th>
            <th>Response Body</th>            
        </tr>       
    </thead>
    <tbody>
        <tr>
            <td>Success</td>
            <td>Staff record updated successfully</td>
            <td>200</td>
            <td><code>
                {
                    "status": "success",
                    "message": "staff record updated successfully"
                }
            </code></td>
        </tr>
        <tr>
            <td>Error</td>
            <td>Staff record not found</td>
            <td>404</td>
            <td><code>
                {
                    "status": "error",
                    "message": "Resource not found"
                }
            </code></td>
        </tr>
        <tr>
            <td>Error</td>
            <td>Invalid request fields</td>
            <td>400</td>
            <td><code>
                {
                    "status": "error",
                    "message": [
                        "The email must be a valid email address."
                    ]
                }
            </code></td>
        </tr>    
        <tr>
            <td>Error</td>
            <td>Email already exists</td>
            <td>400</td>
            <td><code>
                {
                    "status": "error",
                    "message": "email already exists"
                }
            </code></td>
        </tr>
    </tbody>
</table>

<h3><a name="endpoint_delete_rec">Delete a Staff Record</a></h3>
<p><b>URL:</b> http://localhost/api/staff/<span class="staff_id_url_segment">{staffid}</span><br/>
<b>Method:</b> DELETE<br/>
<b>Content-Type:</b> application/json</br/>
</p>
<table class="">
    <caption>
        API Response Details
    </caption>
    <thead>
        <tr>
            <th>Status</th>
            <th>Description</th>
            <th>Response Code</th>
            <th>Response Body</th>            
        </tr>       
    </thead>
    <tbody>
        <tr>
            <td>Success</td>
            <td>Staff record deleted successfully</td>
            <td>200</td>
            <td><code>
                {
                    "status": "success",
                    "message": "staff record updated successfully"
                }
            </code></td>
        </tr>
        <tr>
            <td>Error</td>
            <td>Staff record not found</td>
            <td>404</td>
            <td><code>
                {
                    "status": "error",
                    "message": "Resource not found"
                }
            </code></td>
        </tr>
    </tbody>
</table>

<h3><a name="endpoint_view_rec">View a Staff Record</a></h3>
<p>
<b>URL:</b> http://localhost/api/staff/<span class="staff_id_url_segment">{staffid}</span><br/>
<b>Method:</b> GET<br/>
<b>Content-Type:</b> application/json
</p>
<table class="">
    <caption>
        API Response Details
    </caption>
    <thead>
        <tr>
            <th>Status</th>
            <th>Description</th>
            <th>Response Code</th>
            <th>Response Body (Example for successful operation)</th>            
        </tr>       
    </thead>
    <tbody>
        <tr>
            <td>Success</td>
            <td>Staff record returned successfully</td>
            <td>200</td>
            <td><code>
                {
                    "id": 6,
                    "email": "mertie.roob@gmail.com",
                    "first_name": "Nikita",
                    "last_name": "Lockman",
                    "status": "Active",
                    "squad": "squad2",
                    "start_date": "1998-08-31",
                    "notes": "Deleniti magni aut quo. Ratione eum ea ut optio.",
                    "created_at": "2022-11-09T11:25:35.000000Z",
                    "updated_at": "2022-11-09T11:25:35.000000Z",
                    "full_name": "Nikita Lockman"
                }
            </code></td>
        </tr>
        <tr>
            <td>Error</td>
            <td>Staff record not found</td>
            <td>404</td>
            <td><code>
                {
                    "status": "error",
                    "message": "Resource not found"
                }
            </code></td>
        </tr>
    </tbody>
</table>



<h3><a name="endpoint_list_all">List all Staff Records</a></h3>
<p>
<b>URL:</b> http://localhost/api/staff<br/>
<b>Method:</b> GET<br/>
<b>Content-Type:</b> application/json
</p>

<table class="">
    <caption>
        API Response Details
    </caption>
    <thead>
        <tr>
            <th>Status</th>
            <th>Description</th>
            <th>Response Code</th>
            <th>Response Body (Example)</th>            
        </tr>       
    </thead>
    <tbody>
        <tr>
            <td>Success</td>
            <td>Staff record returned successfully</td>
            <td>200</td>
            <td><code>                
                [{
                    "id": 1,
                    "email": "raoul34@kuhic.org",
                    "first_name": "Imelda",
                    "last_name": "Rolfson",
                    "status": "Active",
                    "squad": "squad1",
                    "start_date": "2017-02-23",
                    "notes": "Libero impedit atque autem veritatis voluptas aperiam. Et et vel magnam temporibus voluptatem est distinctio. Et voluptatem molestiae perspiciatis amet accusamus adipisci maiores quam. Tempora atque commodi voluptas temporibus maxime sequi."
                },
                {
                    "id": 2,
                    "email": "corkery.liza@gmail.com",
                    "first_name": "Arvid",
                    "last_name": "Flatley",
                    "status": "Inactive",
                    "squad": "squad5",
                    "start_date": "2015-09-20",
                    "notes": "Placeat optio neque accusantium. Officiis quisquam et aliquid architecto. Quia veritatis suscipit fugit voluptas quia magnam. Vel qui quaerat tenetur culpa modi repellendus officiis."
                }]
            </code></td>
        </tr>
        <tr>
            <td>Error</td>
            <td>Staff record not found</td>
            <td>404</td>
            <td><code>
                {
                    "status": "error",
                    "message": "Resource not found"
                }
            </code></td>
        </tr>
    </tbody>
</table>
<br/><br/>

</body>