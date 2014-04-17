<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function searchBox(){
    echo"
        <div class=\"container\">
            <div class='row'>
		<div class='col-lg-12 text-center'>
                    <h1>
                        Widgets and Wingdings<br>
                        <small>The first and only of its kind</small>
                    </h1>
                </div>
            </div>
            <div class='row'>
                <div class='col-lg-12'>
                    <p>
                        &nbsp
                    </p>
                </div>
            </div>
            <div class='row'>
                <div class='col-lg-12 text-center'>
                    <form action='search_handle.php' method='POST' class='form-search'>
                        <h4>Item Search</h4>
                        <input type='text' size='50' class='input-medium search-query' name='term' placeholder='Search for an Item'>		
                        <button type='submit' name='search' value='search' class='btn'>Submit</button>
                    </form>
                </div>
            </div>
        </div>
	";
}
