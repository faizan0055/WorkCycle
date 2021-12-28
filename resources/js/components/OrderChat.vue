<template>

<div class="container">
<button type="button" class="btn btn-primary"  @click="showChatModel()">
                Chat
                      </button>


                      <div class="modal fade right" id="chatPopUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" style="height:400px;">

  <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="card chat-room small-chat wide" id="myForm">
       <!--  <div class="card-header white d-flex justify-content-between p-2" id="toggle" style="cursor: pointer;">
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
          
          <div class="icons grey-text">
            <a class="feature"><i class="fas fa-video mr-2"></i></a>
            <a class="feature"><i class="fas fa-phone mr-2"></i></a>
            <a class="feature"><i class="fas fa-cog mr-2"></i></a>
            <a id="closeButton" onclick="closeModal()"><i class="fas fa-times mr-2"></i></a>
          </div>
        </div> -->
        <div class="my-custom-scrollbar" id="message">
          <div class="card-body p-3">
            <div class="chat-message">
              <div class="media mb-3">
                <img class="d-flex rounded-circle mr-2" width="100" src="http://127.0.0.1:8000/images/default.jpg" alt="Generic placeholder image">
                <!-- <div class="media-body">
                  <p class="my-0">You're friends on Facebook</p>
                  <p class="mb-0 text-muted">Web Designer at MDBootstrap</p>
                  <p class="mb-0 text-muted">Lives in Paris</p>
                </div> -->
              </div>

              <div v-for="(messages, key) in myChatWith" >
              
            <div v-if="messages.sender_id!=my_id" class="incoming_msg">
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
                <a :href="/images/+messages.image_name" target="_blank"><p>Download Video</p></a>
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
            </div>
          </div>
        </div>
        <div class="card-footer text-muted white pt-1 pb-2 px-3">
          <input v-model="messageBody" type="text" class="write_msg" placeholder="Type a message"/>

              <form name="myForm" enctype="multipart/form-data" class="form-horizontal d-none">
                  <input type="file" name="image" id="file-input"  v-on:change="onImageChange" class="form-control-file"/>
              </form>
              
              <button class="btn-info btn" @click="sendOrderMessage()" type="button">Send</button>
         <!--  <div>
            <a><i class="far fa-file-image mr-2"></i></a>
            <a><i class="far fa-laugh mr-2"></i></a>
            <a><i class="fas fa-gamepad mr-2"></i></a>
            <a><i class="fas fa-paperclip mr-2"></i></a>
            <a><i class="fas fa-camera mr-2"></i></a>
            <a><i class="fas fa-thumbs-up float-right"></i></a>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</template>

<script>
	export default{
		props:["my_id","my_name","order_id"],

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
			console.log(this.my_id+'-----'+this.my_name);
			//this.setingDatabase();
			},

		created(){

		},

    closeModal(){
        $('#chatPopUp').modal('hide');
      },

		methods:{
			checkDate(){
				console.log(new Date().toLocaleString());
				this.dateandtime = new Date().toLocaleString().replace(/[^0-9]/g, "");
				console.log(this.dateandtime);
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
					var query = firebase.database().ref("FireChatFire/OrderChat/Order_No_"+this.order_id);

					query.on('value', (snapshot) => {
						console.log(snapshot.val());

						var key = Object.keys(snapshot.val())[0];

						console.log('selected'+this.receiver_id);
						console.log(key);
						if (this.order_id==snapshot.val()[key].receiver_id) {//this receiver_id==sender_id
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

        showChatModel(){

        this.receiver_id=1;

        this.myChatWith=[];
        this.getChat(this.order_id);
        $("#chatPopUp").modal("show");
      },

			setReceiverId(order_id,rest_id){
        console.log('order_id'+order_id);
        console.log('rest id'+rest_id);

				this.receiver_id=rest_id;
        this.order_id=order_id;

				this.myChatWith=[];
				this.getChat(this.order_id);
			},


      setPopUpId(order_id,rest_id){
        console.log('order_id'+order_id);
        console.log('rest id'+rest_id);

        this.receiver_id=rest_id;
        this.order_id=order_id;

        this.myChatWith=[];
        this.getChat(this.order_id);
        $("#chatPopUp").modal("show");
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
                        sender_id:this.my_id,
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
                        sender_id:this.my_id,
                        receiver_id:this.order_id,
                        is_image:false,
                        image_name:this.image_name,
                        message:this.messageBody,
                        dateandtime:this.dateandtime,
                    });
        }
        this.messageBody='';
                    this.image='';
                    this.getChat(this.receiver_id);
      },

			allOrders(){
				axios.get('/allOrders').then(response=>{
					this.allUser=response.data;
				})
			},

			setingDatabase(){
  				firebase.database().ref("FireChatFire").set({
               		Inbox:'',
                	Chat:'' ,
                  OrderChat:'',
            	});
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
<style>
.container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: rest_idpx;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
</style>