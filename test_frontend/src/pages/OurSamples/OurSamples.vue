<template>
  <div>
    <b-row>
      <b-col xs="12" lg="6">
        <Widget>
          <h4>Here is our work space</h4>
          <p>{{message}}</p>
          <h3>{{declared}}</h3>
          <a :href="facebook">Click here to visit Facebook</a>
          <button :disabled="isButtonDisabled" >Button</button>
          <h5>{{arr+1}}</h5>
          <h5>1+1</h5>
        </Widget>
      </b-col>
    </b-row>
  </div> 
</template>

<script>
    import Widget from '@/components/Widget/Widget';

    export default {
        name: 'OurSamples',
        components: {
            Widget 
        },
        props:[
           
        ],
        data: () => ({
            message:'I am a boy',
            declared:'',
            facebook:"https://web.facebook.com/?_rdc=1&_rdr",
            isButtonDisabled:false,
            arr:9
            
        }),
        methods: {
            checkOdd(){
               if (this.arr % 2 == 0) {
                    this.isButtonDisabled=false;
               }else{
                this.isButtonDisabled=true;
               }
            }
        },
        mounted(){
            this.declared='Hi Mr Dan!!!'
            this.checkOdd()
        }

    }
</script>

<style scoped>

</style>
