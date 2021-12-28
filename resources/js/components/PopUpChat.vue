<template>
	<div class="container">
		<!-- Side Modal Top Right -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary"  @click="showChatModel()">
  Chat
</button>

<!-- To change the direction of the modal animation change .right class -->
<div class="modal fade right" id="chatPopUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" style="height:400px;">

  <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="card chat-room small-chat wide" id="myForm">
        <div class="card-header white d-flex justify-content-between p-2" id="toggle" style="cursor: pointer;">
          <div class="heading d-flex justify-content-start">
            <div class="profile-photo">
              <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" alt="avatar" class="avatar rounded-circle mr-2 ml-0">
              <span class="state"></span>
            </div>
            <div class="data">
              <p class="name mb-0"><strong>John Smith</strong></p>
              <p class="activity text-muted mb-0">Active now</p>
            </div>
          </div>
          <ul>
			<li v-for="(messages, key) in myChatWith">{{ messages.message }}</li>
		 </ul>
          <div class="icons grey-text">
            <a class="feature"><i class="fas fa-video mr-2"></i></a>
            <a class="feature"><i class="fas fa-phone mr-2"></i></a>
            <a class="feature"><i class="fas fa-cog mr-2"></i></a>
            <a id="closeButton" @click="closeModal()"><i class="fas fa-times mr-2"></i></a>
          </div>
        </div>
        <div class="my-custom-scrollbar" id="message">
          <div class="card-body p-3">
            <div class="chat-message">
              <div class="media mb-3">
                <img class="d-flex rounded mr-2" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" alt="Generic placeholder image">
                <div class="media-body">
                  <p class="my-0">You're friends on Facebook</p>
                  <p class="mb-0 text-muted">Web Designer at MDBootstrap</p>
                  <p class="mb-0 text-muted">Lives in Paris</p>
                </div>
              </div>

              <div v-for="(messages, key) in myChatWith" >
          		
            <div v-if="messages.sender_id!=my_pop_id" class="incoming_msg">
              <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p v-if="messages.message">{{ messages.message }}</p>

                  <div v-if="messages.is_image">
                  	<!-- if video=true -->
                  	<div v-if="checkExtension(messages.image_name)">
                  		<video :poster="/images/+messages.image_name" class="video-fluid" controls>
          					<source 
          					:src="/images/+messages.image_name"/>
        				</video>
        				<!-- <a :href="/images/+messages.image_name" target="_blank"><p>Download Video</p></a> -->
                  	</div>
                  	<div v-else>
                  		<img width="100px" height="100px" :src="/images/+messages.image_name" alt="sunil">
                  	</div>

                  </div>

                  <!-- <div>
                  	<video class="video-fluid" autoplay loop muted>
          				<source src="https://mdbootstrap.com/img/video/Lines.mp4"/>
        			</video>
                  </div> -->
                  <span class="time_date"> 11:01 AM    |    June 9</span>
              </div>
              </div>
            </div>

            <div v-else class="outgoing_msg">
              <div class="sent_msg">
                <p v-if="messages.message">{{ messages.message }}</p>
                  <div v-if="messages.is_image">
                  	<!-- if video=true -->
                  	<div v-if="checkExtension(messages.image_name)">
                  		<video :poster="/images/+messages.image_name" class="video-fluid" controls>
          					<source 
          					:src="/images/+messages.image_name"/>
        				</video>
        				<!-- <a class="text-center" :href="/images/+messages.image_name" target="_blank">Download Video</a> -->
                  	</div>
                  	<div v-else>
                  		<img width="100px" height="100px" :src="/images/+messages.image_name" alt="sunil">
                  	</div>

                  </div>
                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
            </div>

          	</div>

              <!-- <div class="card bg-primary rounded w-75 float-right z-depth-0 mb-1">
                <div class="card-body p-2">
                  <p class="card-text text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit voluptatem cum eum tempore.</p>
                </div>
              </div>
              

             <div class="card bg-light rounded w-75 z-depth-0 mb-1 message-text">
                <div class="card-body p-2">
                  <p class="card-text black-text">Nostrum minima cupiditate assumenda, atque cumque hic voluptatibus at corporis maxime quam harum.</p>
                </div>
              </div> -->
            </div>
          </div>
        </div>
        <div class="card-footer text-muted white pt-1 pb-2 px-3">
          <input v-model="messageBody" type="text" class="write_msg" placeholder="Type a message" />

              <form name="myForm" enctype="multipart/form-data" class="form-horizontal">
              		<input  type="file" name="image" id="file-input"  v-on:change="onImageChange" class="form-control-file" />
              </form>
              
              <button @click="sendOrderMessage()" type="button">Send</button>
          <div>
            <a><i class="far fa-file-image mr-2"></i></a>
            <a><i class="far fa-laugh mr-2"></i></a>
            <a><i class="fas fa-gamepad mr-2"></i></a>
            <a><i class="fas fa-paperclip mr-2"></i></a>
            <a><i class="fas fa-camera mr-2"></i></a>
            <a><i class="fas fa-thumbs-up float-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Side Modal Top Right -->
	</div>
</template>
<script>
	export default{
		props:["my_pop_id","order_id"],

		data(){
			return {
				receiver_id:0,
				allUser:[],
				messageBody:'',
				inboxList:[],
				post:[],
				blogsArray:[],
				myChatWith:[],
				receiver_name:'',
				image:'',
				image_name:'',
				dateandtime:'',
			};
		},

		mounted(){
			console.log('pop up chat');
			this.myChatWith=[];
			},

		created(){

		},

		methods:{
			checkDate(){
				console.log(new Date().toLocaleString());
				this.dateandtime = new Date().toLocaleString().replace(/[^0-9]/g, "");
				console.log(this.dateandtime);
			},

			showChatModel(){
				this.myChatWith=[];
				console.log(this.order_id);
				this.getChat(this.order_id);
				$("#chatPopUp").modal("show");
			},

			closeModal(){
				$('#chatPopUp').modal('hide');
			},



			onImageChange(e) {
      			console.log(e.target.files[0]);
      			this.image = e.target.files[0];

		      			const config = {
		          headers: { "content-type": "multipart/form-data" }
		        };

		        let formData = new FormData();
		        formData.append("image", this.image);
		        var ab='';
		        console.log(formData);
		        axios
		          .post("/moveImage", formData, config)
		          .then(response=> {
		            //console.log(response.data);
		            ab=response.data.image;
		            this.image_name=ab;
		          console.log("image name: "+this.image_name); 
		          // this.setImage_name(ab);
		          });		          
    		},

			getChat(id){
				   var chatArry=[];
				   this.myChatWith=[];
					var query = firebase.database().ref("FireChatFire/OrderChat/Order_No_17");
					id=17;

					query.on('value', (snapshot) => {
						console.log(snapshot.val());

						var key = Object.keys(snapshot.val())[0];

						console.log('selected'+this.receiver_id);
						console.log(key);
						if (id==snapshot.val()[key].receiver_id) {//this receiver_id==sender_id
							chatArry=[];
							  snapshot.forEach(function(childSnapshot) {
							    var childData = childSnapshot;
							      chatArry.push(childData.val());
							  });
							  this.myChatWith = chatArry;
							  console.log(this.myChatWith);
						}else{
							console.log('Keep going');
						}
					});
			},

			setReceiverId(order_id,rest_id){
        console.log('order_id'+order_id);
        console.log('rest id'+rest_id);

				this.receiver_id=rest_id;
        this.order_id=order_id;

				this.myChatWith=[];
				this.getChat(this.order_id);
			},

      sendOrderMessage(){
        
        this.dateandtime = new Date().toLocaleString().replace(/[^0-9]/g, "");
        console.log(this.dateandtime);
        console.log('send message is called');
        // this.blogsArray=[];
        document.forms["myForm"]["image"].value ='';
              // this.myChatWith=[];

        if (this.image_name!='') {
            //if user attch any image
            firebase.database()
              .ref("FireChatFire/OrderChat/Order_No_"+this.order_id).push().set({
                        sender_id:this.my_pop_id,
                        receiver_id:this.order_id,
                        is_image:true,
                        image_name:this.image_name,
                        message:this.messageBody,
                        dateandtime:this.dateandtime
                    });
        } else {
          //if user does't attach any image
              
            firebase.database()
              .ref("FireChatFire/OrderChat/Order_No_"+this.order_id).push().set({
                        sender_id:this.my_pop_id,
                        receiver_id:this.order_id,
                        is_image:false,
                        image_name:this.image_name,
                        message:this.messageBody,
                        dateandtime:this.dateandtime,
                    });
        }
        this.messageBody='';
                    this.image='';
                    this.getChat(this.order_id);
      },

  			checkExtension(fileName){

  				console.log(fileName);
  				if ( /\.(jpe?g|png|gif|webp|jpg|web)$/i.test(fileName) === false ) 
					    { 
					    	console.log('file is this png');
					}

  				if ( /\.(jpe?g|png|gif|webp|jpg|web)$/i.test(fileName) === false ) 
			    { 
			    	console.log(fileName);
			    	return true;
			    }else{
			    	console.log(fileName);
			    	return false;
			    }
  			},
		},
	}
</script>