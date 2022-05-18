<template>
      <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © {{currentYear}} {{this.$store.state.companyData.name}} . All rights reserved. <a href="javascript:void(0)">Priceline</a>.</p>
                                </div>
                            </div>
                        </div>
</template>
<script>

export default {
  data(){
      return {
          currentYear: (new Date()).getFullYear()
      }
  }
}
</script>
