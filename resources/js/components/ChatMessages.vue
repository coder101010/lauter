<template>
  <div class="c-Messages">
    <div class="msg left clearfix" v-for="message in messages" :key="message.id">

      <div class="c-Message container" :class="{ 'justify-content-right' : message.user.id === userid  }">
        <div class="c-Message_wrapper d-flex align-items-center">
            <div class="c-Message_avatar image"> <avatar :username="message.user.name"></avatar> </div>
            <div class="c-Message_body">
                <div class="c-Message_bio">
                <div class="c-Message_min-avatar image"> <avatar :username="message.user.name"></avatar> </div>
                <h4 class="c-Message_username mb-0 mt-0">{{ message.user.name }}</h4> 
                </div>
                <div class="c-Message_frame p-2 mt-2 d-flex justify-content-between rounded text-white stats">
                  <div v-linkified>
                    <img :src="message.attachment" class="c-Message_attachment" width="100%" v-if="message.attachment" />
                    <div class="c-Message_text">{{ message.message }}</div>
                  </div>
                </div>
                <div v-if="message.created_at" class="c-Message_created">{{ message.created_at | moment('from', 'now') }}</div>
            </div>
        </div>
      </div>

    </div>
  </div>

</template>

<script>
export default {
  props: ["messages","userid", "attachment", "created_at"],
};
</script>
