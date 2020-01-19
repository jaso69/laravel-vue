<template>
  <form @submit.prevent="register" class="px-5 py-2">
    <v-text-field
      v-model="name"
      :error-messages="nameErrors"
      :counter="20"
      label="Name"
      required
      @input="$v.name.$touch()"
      @blur="$v.name.$touch()"
    ></v-text-field>
    <v-text-field
      v-model="email"
      :error-messages="emailErrors"
      label="E-mail"
      required
      @input="$v.email.$touch()"
      @blur="$v.email.$touch()"
    ></v-text-field>
    <v-text-field
      type = "password" 
      v-model="password"
      :error-messages="passwordErrors"
      label="Password"
      required
      @input="$v.password.$touch()"
      @blur="$v.password.$touch()"
    ></v-text-field>
    <v-text-field
      type = "password" 
      v-model="password_confirmation"
      :error-messages="password_confirmationErrors"
      label="Repite password"
      required
      @input="$v.password_confirmation.$touch()"
      @blur="$v.password_confirmation.$touch()"
    ></v-text-field>

    <v-btn class="mr-4" type="submit">submit</v-btn>
    <v-btn @click="clear">clear</v-btn>
  </form>
</template>

<script>
  import { validationMixin } from 'vuelidate'
  import { required, maxLength, email, minLength} from 'vuelidate/lib/validators'

  export default {
    mixins: [validationMixin],

    validations: {
      name: { required, maxLength: maxLength(20) },
      email: { required, email },
      password:{required, minLength: minLength(8)},
      password_confirmation:{required, minLength: minLength(8)},
    },

    data: () => ({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',

    }),

    computed: {
     
      nameErrors () {
        const errors = []
        if (!this.$v.name.$dirty) return errors
        !this.$v.name.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.name.required && errors.push('Name is required.')
        return errors
      },
      emailErrors () {
        const errors = []
        if (!this.$v.email.$dirty) return errors
        !this.$v.email.email && errors.push('Must be valid e-mail')
        !this.$v.email.required && errors.push('E-mail is required')
        return errors
      },
      passwordErrors () {
        const errors = []
        if (!this.$v.password.$dirty) return errors
        !this.$v.password.minLength && errors.push('password must be at most 8 characters long')
        !this.$v.password.required && errors.push('password is required.')
        return errors
        
      },
      password_confirmationErrors () {
        const errors = []
        if (!this.$v.password_confirmation.$dirty) return errors
        !this.$v.password_confirmation.minLength && errors.push('password must be at most 8 characters long')
        !this.$v.password_confirmation.required && errors.push('password is required.')
        return errors
      },
    },

    methods: {

      register(){

        this.$v.$touch();

        if(this.password != this.password_confirmation) return alert('Password no coinciden');

        axios.post('/api/register', {
          name: this.name,
          email: this.email,
          password: this.password,
        })
                    .then(res => {
                        console.log(res);
                        this.$router.replace('/');
                    })
                    .catch(err => {
                        alert(err.response.data.message);
                    })

      },

      submit () {
        this.$v.$touch();
        this.register();
      },
      clear () {
        this.$v.$reset()
        this.name = ''
        this.email = ''
        this.password = ''
        this.password_confirmation = ''
      },
    },
  }
</script>