<template>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4">
					
				</div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12">
							<div class="card grey lighten-3 chat-room">
							  <div class="card-body">

							    <!-- Grid row -->
							    <div class="row px-lg-2 px-2">

							      <!-- Grid column -->
							      <div class="col-md-6 col-xl-4 px-0">

							        <h6 class="font-weight-bold mb-3 text-center text-lg-left">Member</h6>
							        <div class="white z-depth-1 px-3 pt-3 pb-0">
							          <ul class="list-unstyled friend-list">
							            <li class="active grey lighten-3 p-2">
							              <a href="#" class="d-flex justify-content-between">
							                <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-8.jpg" alt="avatar" class="avatar rounded-circle d-flex align-self-center mr-2 z-depth-1">
							                <div class="text-small">
							                  <strong>John Doe</strong>
							                </div>
							                <div class="chat-footer">
							                  <span class="badge badge-danger float-right">1</span>
							                </div>
							              </a>
							            </li>
							          </ul>
							        </div>

							      </div>
							      <!-- Grid column -->

							      <!-- Grid column -->
							      <div class="col-md-6 col-xl-8 pl-md-3 px-lg-auto px-0">

							        <div class="chat-message">

							          <ul class="list-unstyled chat">
							           
							            <li class="white">
							              <div class="form-group basic-textarea">
							                <textarea v-model="messageBody" class="form-control pl-2 my-0" id="exampleFormControlTextarea2" rows="3" placeholder="Type your message here..."></textarea>
							              </div>
							            </li>
							            <button @click="callme()" type="button" class="btn btn-info btn-rounded btn-sm waves-effect waves-light float-right">Send</button>
							            <button @click="callmechild()" type="button" class="btn btn-info btn-rounded btn-sm waves-effect waves-light float-right">callmechild</button>

							            <button @click="addUser()" type="button" class="btn btn-info btn-rounded btn-sm waves-effect waves-light float-right">Add User</button>
							            <button @click="sendMessage()" type="button" class="btn btn-info btn-rounded btn-sm waves-effect waves-light float-right">Send Message</button>
							          </ul>

							        </div>

							      </div>
							      <!-- Grid column -->

							    </div>
							    <!-- Grid row -->

							  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<ul>
					<li></li>
				</ul>
			</div>
			<div class="col-md-8">
			</div>
		</div><br><br><br>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-4">
						Add User <br>
						<input class="form-control" type="text" v-model="email"> <br>
						<input class="form-control" type="text" v-model="name"> <br>
						
						<button class="btn btn-info" @click="addUser()">Add User</button>
					</div>
					<div class="col-md-4">
						Send Message <br>
						<div class="form-group basic-textarea">
							                <textarea v-model="messageBody" class="form-control pl-2 my-0" id="exampleFormControlTextarea2" rows="3" placeholder="Type your message here..."></textarea>
							              </div>
							           <br>
						<button class="btn btn-info" @click="sendMessage()">Add User</button>
					</div>
					<div class="col-md-4">
						<button class="btn btn-info" @click="retriveData()">Show Me</button>
					<br>
					<button class="btn btn-info" @click="getMessages()">Get Messages</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
  props: ["id"],

  data() {
    return {
      messageBody:'',
      allMessages:[],
      email:'',
      name:'',
    };
  },

  mounted() {
  	//this.setingDatabase();
  },
  created() {
    /*if (true) {
      this.interval = setInterval(() => this.threading(), 1000);
    }*/
  },

  methods: {
  	setingDatabase(){
  		firebase.database().ref("SigiChat").set({
                Users:'',
                Friends:'',
                Inbox:'' ,
            });
  	},

  	addUser(){
  		firebase.database().ref("SigiChat").child("Users").push().set({
  			email:this.email, name:this.name,
  		});
  		this.email="";
  		this.name="";
  	},

	sendMessage(){
  		firebase.database().ref("SigiChat").child("Inbox").push().set({
  			sender_id:'2', receiver_id:'1', message:this.messageBody,
  		});
  		this.messageBody="";
  	},

  	retriveData(){
  		var query = firebase.database().ref("SigiChat/Inbox").orderByKey();

				query.on('value', function(snapshot) {
					    snapshot.forEach(function(childSnapshot) {
					      var childData = childSnapshot.val();
					      console.log(childData);
					    });
					});


  		/*var headFire=firebase.database().ref("SigiChat").child("Users");
  		headFire.on('value',function(datasnap){
  			console.log(datasnap.val());
  			console.log(Object.keys(datasnap.val())[0]).child("email"); // first index key
  			console.log(Object.keys(datasnap.val())); // all keys
  			
  		});*/
  	},

  	getMessages(){

  		var query = firebase.database().ref("SigiChat").child("Inbox").orderByKey();
				query.once("value")
				  .then(function(snapshot) {
				    snapshot.forEach(function(childSnapshot) {
				      // key will be "ada" the first time and "alan" the second time
				      var key = childSnapshot.key;
				      console.log(key);
				      // childData will be the actual contents of the child
				      var sender_id = childSnapshot.child("sender_id").val();
					  var receiver_id = childSnapshot.child("receiver_id").val();
					  var message   =childSnapshot.child("message").val();

					  if ((sender_id=='1' && receiver_id=='2') || (sender_id=='2' && receiver_id=='1')) {
					  	console.log('message is :'+message);
					  }

				      // console.log(childData);
				  });
			});

  	},


  	sendTo(){
  		console.log('Hello');
  	},

  	callme(){
  		firebase.database().ref("inbox").child("message").push().set({
  			name:'this', last:'dksal'
  		});
  	},
  	callmechild(){
  		firebase.database().ref("inbox").push().set({
  			sender:1, rece:2, mes:'kldsf'
  		});
  	},
  	addChild(){
  		console.log('callme');
  		firebase.database().ref("inbox").set({
                sender_id:"Haider",
                receiver_id:"Ali",
                message: "Hello my friend how are you",
            });
  	},
  }
};

$(document).ready(function() {
  //alert('ready','hjhjhj');
});
</script>		