<?php  
	$title = "homestay";
	function get_content() {
	require_once 'controllers/connection.php';

	$query = "SELECT * FROM categories";
	$stmt = $cn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	$categories = $result->fetch_all(MYSQLI_ASSOC);
	// var_dump($categories);

	$homestays_query = "SELECT * FROM homestay";
	$homestay_stmt = $cn->prepare($homestays_query);
	$homestay_stmt->execute();
	$homestays_result = $homestay_stmt->get_result();
	$homestays = $homestays_result->fetch_all(MYSQLI_ASSOC);
	
?>
  		<header>
	  		<div>
	  		<video preload="auto" width="100%" autoplay="" muted="" loop="" src="/assets/img/header.mp4"></video>
	  		<!-- <iframe src="https://www.maddogg.com/video/homepage-video_web.mp4"></iframe> -->
	  		</div>

	  		<div class="hero-text text-white">
	  			<h1 class="font-weight-light text-white">Unexpected Journey</h1>
	  			<h6 class="mt-3">"To feel at home, stay with us"</h6>
	  		</div>
  		</header>

  		<div class="container">
			<div class="row">
			    <div class="col-lg-12 card-margin mt-5">
			        <div class="card search-form">
			            <div class="card-body p-0">
			                <form id="search-form">
			                    <div class="row">
			                        <div class="col-12">
			                            <div class="row no-gutters">
			                                <div class="col-lg-3 col-md-3 col-sm-12 p-0">
			                                    <select class="form-control selected" id="exampleFormControlSelect1">
			                                        <option>Location</option>
			                                        <option>Penang</option>
			                                        <option>Kuala Lumpur</option>
			                                        <option>Kedah</option>
			                                        <option>Perak</option>
			                                        <option>Pahahng</option>
			                                        <option>Johor</option>
			                                    </select>
			                                </div>
			                                <div class="col-lg-8 col-md-6 col-sm-12 p-0">
			                                    <input type="text" placeholder="Search..." class="form-control" id="search" name="search">
			                                </div>
			                                <div class="col-lg-1 col-md-3 col-sm-12 p-0">
			                                    <button type="submit" class="btn btn-base">
			                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
			                                    </button>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </form>
			            </div>
			        </div>
			    </div>
			</div>

<div class="container">
	<?php if(isset($_SESSION["user_details"]) && $_SESSION["user_details"]["isAdmin"]): ?>
	<form class="py-5 col-md-6 mx-auto" method="POST" action="/controllers/products/add_product.php" enctype="multipart/form-data">
		<div class="mb-3">
			<label>Name</label>
			<input type="text" name="homestay_name" class="form-control">
		</div>
		<div class="mb-3">
			<label>Price</label>
			<input type="number" name="price" class="form-control">
		</div>
		<div class="mb-3">
			<label>Image</label>
			<input type="file" name="image" class="form-control">
		</div>
		<div class="mb-3">
			<label>Image</label>
			<input type="file" name="image1" class="form-control">
		</div>
		<div class="mb-3">
			<label>Image</label>
			<input type="file" name="image2" class="form-control">
		</div>
		<div class="mb-3">
			<label>Category</label>
			<select name="category_id" class="form-select">
				<?php foreach($categories as $category): ?>
					<option value="<?php echo $category['category_id'] ?>">
						<?php echo $category["name"]; ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class='mb-3'>
			<label>Address</label>
			<textarea class="form-control" name="address" rows="3"></textarea>
		</div>
		<div class='mb-3'>
			<label>Description</label>
			<textarea class="form-control" name="description" rows="5"></textarea>
		</div>
		<button class="btn btn-success">Book</button>
	</form>
	<?php endif; ?>
</div>

<div class="container">
	<div class="row">
		<?php foreach($homestays as $homestay): ?>	
			<div class="col-md-4 py-5">
				<div class="card">					
					<img src="<?php echo $homestay['image'] ?>" class="card-img-top">
					<div class="card-body">
						<a href="/views/product_details.php?id=<?php echo $homestay['house_id']?>"><h5 class="card-title"><?php echo $homestay["name"] ?></h5></a>
						<p class="card-text"><?php echo $homestay['address'] ?></p>
						<p class="card-text"><?php echo $homestay['description'] ?></p>
						<strong>RM <?php echo $homestay['price'] ?></strong>
					</div>
					<?php if(isset($_SESSION["user_details"]) && !$_SESSION["user_details"]["isAdmin"]): ?>
					<div class="card-footer">
						<div class="input-group">
							<input type="number" name="quantity" class="form-control" min="">
							<input type="number" name="quantity" class="form-control" min="">
							<button class="btn btn-outline-success add-to-cart" data-id="<?php echo $homestay['house_id'] ?>">Book</button>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
</div>


<div class="container">
	<h1 class="text-center mb-3">-Special Offer-</h1>
	<hr class="hr-rose mx-auto my-4">
	<div class="row">
		<figure class="snip1208">
			  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample101.jpg" alt="sample66" />
			  <div class="date"><span class="day">28</span><span class="month">Oct</span></div><i class="ion-film-marker"></i>
			  <figcaption>
			    <h3>Last Minutes Deals Up to 80%</h3>
			    <p>
			      This is the special offer for every that using our website. So, you will have the privilege to use our exclusive package_"Last Minutes Deals Up to 80%".
			    </p>
			    <button>Read More</button>
			  </figcaption><a href="#"></a>
			</figure>
			<figure class="snip1208">
			  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample9.jpg" alt="sample9" />
			  <div class="date"><span class="day">17</span><span class="month">Nov</span></div><i class="ion-headphone"> </i>
			  <figcaption>
			    <h3>Creating Social Media Posts</h3>
			    <p>
			      This is the special offer for every that using our website. So, you will have the privilege to use our exclusive package_"Creating Social Media Posts !".
			    </p>
			    <button>Read More</button>
			  </figcaption><a href="#"></a>
			</figure>
			<figure class="snip1208">
			  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample6.jpg" alt="sample6" />
			  <div class="date"><span class="day">01</span><span class="month">Dec</span></div><i class="ion-checkmark"> </i>
			  <figcaption>
			    <h3>Stay together for school holidays</h3>
			    <p>
			      This is the special offer for every that using our website. So, you will have the privilege to use our exclusive package_"Stay together for school holidays".
			    </p>
			    <button>Read More</button>
			  </figcaption><a href="#"></a>
			</figure>
			<figure class="snip1208">
			  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample34.jpg" alt="sample9" />
			  <div class="date"><span class="day">25</span><span class="month">Dec</span></div><i class="ion-headphone"> </i>
			  <figcaption>
			    <h3>Special Price for Merry Christmas</h3>
			    <p>
			      This is the special offer for every that using our website. So, you will have the privilege to use our exclusive package_"Special Price for Merry Christmas".
			    </p>
			    <button>Read More</button>
			  </figcaption><a href="#"></a>
			</figure>
	</div>
</div>

	<section >
        <div class="container">
        <h1 class="text-center pb-3">-Gallery-</h1>
        <hr class="hr-rose mx-auto my-4">
        <div class="col-lg-12 ml-auto pr-5">
       <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
		  <ol class="carousel-indicators">
		    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
		    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
		    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
		  </ol>
		  <div class="carousel-inner">
		    <div class="carousel-item active">
		      <img src="assets/img/home.jpg" class="d-block w-100" alt="...">
		    </div>
		    <div class="carousel-item">
		      <img src="assets/img/home.jpg" class="d-block w-100" alt="...">
		    </div>
		    <div class="carousel-item">
		      <img src="assets/img/home.jpg" class="d-block w-100" alt="...">
		    </div>
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="visually-hidden">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="visually-hidden">Next</span>
		  </a>
		</div>
      </div>
    </section>



<footer class="new_footer_area bg_color" id="contact">
            <div class="new_footer_top">
                <div class="container">
				<h1 class="text-center mb-5">-Contact Us-</h1>
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="f_widget company_widget wow fadeInLeft" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                <h3 class="f-title f_600 t_color f_size_18">Get the insider travel tips</h3>
                                <p>Inspiration, discounts and homestay recommendations!</p>
                                <form action="#" class="f_subscribe_two mailchimp" method="post" novalidate="true" _lpchecked="1">
                                    <input type="text" name="EMAIL" class="form-control memail" placeholder="Email">
                                    <button class="btn btn_get btn_get_two" type="submit">Subscribe</button>
                                    <p class="mchimp-errmessage" style="display: none;"></p>
                                    <p class="mchimp-sucmessage" style="display: none;"></p>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                                <h3 class="f-title f_600 t_color f_size_18">Download</h3>
                                <ul class="list-unstyled f_list">
                                    <li><a href="#">Company</a></li>
                                    <li><a href="#">Android App</a></li>
                                    <li><a href="#">Ios App</a></li>
                                    <li><a href="#">Desktop</a></li>
                                    <li><a href="#">Projects</a></li>
                                    <li><a href="#">My tasks</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInLeft;">
                                <h3 class="f-title f_600 t_color f_size_18">Help</h3>
                                <ul class="list-unstyled f_list">
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Term &amp; conditions</a></li>
                                    <li><a href="#">Reporting</a></li>
                                    <li><a href="#">Documentation</a></li>
                                    <li><a href="#">Support Policy</a></li>
                                    <li><a href="#">Privacy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <h3 class="f-title f_600 t_color f_size_18">Social Media</h3>
	                            <ul class="list-unstyled list-inline text-center">
							    <li class="list-inline-item">
							      <a class="btn-floating btn-fb mx-1" href="https://www.facebook.com/profile.php?id=100004034881409">
							        <i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i>
							      </a>
							    </li>
							    <li class="list-inline-item">
							      <a class="btn-floating btn-tw mx-1" href="https://www.instagram.com/wchuan_khor1029/">
							        <i class="fa fa-instagram fa-3x" aria-hidden="true"></i>
							      </a>
							    </li>
							    <li class="list-inline-item">
							      <a class="btn-floating btn-gplus mx-1" href="https://mail.google.com/mail/u/0/?tab=wm&ogbl#inbox">
							        <i class="fa fa-google-plus-square fa-3x" aria-hidden="true"></i>
							      </a>
							    </li>
							    <li class="list-inline-item">
							      <a class="btn-floating btn-li mx-1" href="https://www.youtube.com/channel/UCRY-ztC3IgkkJ1DXVWjjJtQ">
							        <i class="fa fa-youtube fa-3x" aria-hidden="true"></i>
							      </a>
							    </li>
							    <li class="list-inline-item">
							      <a class="btn-floating btn-dribbble mx-1" href="https://twitter.com/login?redirect_after_login=https%3A%2F%2Fads.twitter.com%2Flogin&hide_message=1">
							        <i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i>
							      </a>
							    </li>
							  </ul>
                        </div>
                    </div>
                </div>
                <div class="footer_bg">
                    <div class="footer_bg_one"></div>
                    <div class="footer_bg_two"></div>
                </div>
            </div>

<script type="text/javascript">
	//synchronous
	//asynchronous
	//fetch, decode, execute
	// fetch("https://jsonplaceholder.typicode.com/posts")
	// .then(response => response.json())
	// .then(data => console.log(data))
	let addToCartButtons = document.querySelectorAll('.add-to-cart');
	addToCartButtons.forEach((indiv_button, i) => {
		indiv_button.addEventListener('click', () => {
			let id = indiv_button.getAttribute("data-id")
			let quantity = indiv_button.previousElementSibling.value

			// alert("Item id: " + id + " quantity added: " + quantity);
			let formBody = new FormData;
			formBody.append('id', id);
			formBody.append('quantity', quantity);

			//fetch("url", options)
			fetch("controllers/cart/add_to_cart.php", {
				method: "POST",
				body: formBody
			})
			.then(res => res.text())
			.then(data => {
				let cartCount = document.getElementById('cart_count')
				if(cartCount.innerHTML != "") {
					cartCount.innerHTML = parseInt(cartCount.innerHTML) + parseInt(quantity);
				} else {
					cartCount.innerHTML = parseInt(quantity);
				}
			})
		})
	})

</script>

<script type="text/javascript">
	  $(".hover").mouseleave(
    function () {
      $(this).removeClass("hover");
    }
  );
</script>

<?php  
	}
	require_once 'views/partials/layout.php';
?>