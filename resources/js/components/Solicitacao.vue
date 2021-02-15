<template>
  <div>
    <div class="form-wizard-step active">
      <div class="form-wizard-step-icon">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          class="w-8"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"
          />
        </svg>
      </div>
      <p>Simulação</p>
    </div>
  </div>
</template>
<script>
export default {};
</script>
<style>
.form-wizard-step {
  padding-top: 10px !important;
  border: 2px solid #fff;
  background: #ccc; 
  -ms-transform: skewX(-30deg); /* IE 9 */
  -webkit-transform: skewX(-30deg); /* Safari */
  transform: skewX(-30deg); /* Standard syntax */
  color: #fff;
}
.form-wizard-step.active {
  /* background: #008080; */
  @apply bg-green-700;
}
</style>  