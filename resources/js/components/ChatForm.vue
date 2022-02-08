<template>
  <div class="c-Draft container">

    <div class="c-Draft_compose">
      <input
        id="btn-input"
        type="text"
        name="message"
        minlength="1"
        maxlength="140"
        class="c-Draft_text form-control"
        placeholder="Say your heart out..."
        value=  this.rndStr(40)
        v-model="newMessage"
        @keyup.enter="sendMessage"
      />
      <div class="c-Draft_cta">
        <img src="/img/send.svg?data" @click="sendMessage" />
      </div>
    </div>

    <div class="c-Draft_compose-footer">
        <div class="c-Draft_image-uploader" v-if="!attachment">
          <label for="file-input">
            <div class="c-Draft_cta gray" @click="removeImage">
              <img src="/img/attachment.svg?data" />
            </div>
          </label>
          <input type="file" id="file-input" @change="onFileChange">
        </div>
        <div class="c-Draft_preview" v-else>
          <div class="c-Draft_preview-thumb">
            <img :src="attachment" />
          </div>
          <div class="c-Draft_cta gray" @click="removeImage">
            <img src="/img/cancel.svg?data" />
          </div>
        </div>

    </div>

  </div>
</template>

<script>
export default {
  props: ["user"],

  data() {
    return {
      newMessage: 'test msg: ' + this.rndStr(40),
      attachment: '',
    };
  },

  methods: {
    rndStr(len) {
    	let text = " "
    	let chars = "abc defghi jkl mno pqr stu vw xyz 123456789";
    
      for( let i=0; i < len; i++ ) {
				text += chars.charAt(Math.floor(Math.random() * chars.length));
      }

			return text;
		},
    sendMessage(e) {

      if (this.newMessage.length < 1 ) {
        return;
      }

      this.$emit("messagesent", {
        user: this.user,
        message: this.newMessage,
        attachment: this.attachment,
      });

      this.newMessage = "";
      this.attachment = '';
    },
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;

      if (!files.length)
        return;

      const file = files[0];

      if ( file.type == 'image/png' || file.type == 'image/jpg'  || file.type == 'image/jpeg' ) {

        if (file.size > 1024 * 1024) {
          e.preventDefault();
          alert('File too big (Max upload: 1MB)');
          return;
        }

      } else {
        e.preventDefault();
        alert('Only PNG/JPEG format is supported!');
        return;
      }

      this.createImage(files[0]);

    },
    createImage(file) {
      var attachment = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.attachment = e.target.result;
      };

      reader.readAsDataURL(file);

    },
    removeImage: function (e) {
      this.attachment = '';
    }    
  },
};
</script>