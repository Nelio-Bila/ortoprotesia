<template>
  <div>
    <HPNavBar />

    <div class="container-fluid">
      <div class="row">
        <HPSideBar currentLink="health_pros" />

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div
            class="
              d-flex
              justify-content-between
              flex-wrap flex-md-nowrap
              align-items-center
              pt-3
              pb-2
              mb-3
              border-bottom
            "
          >
            <h1 class="h2">Profissionais de Saúde</h1>
            <!-- <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">
                  Share
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary">
                  Export
                </button>
              </div>
              <button
                type="button"
                class="btn btn-sm btn-outline-secondary dropdown-toggle"
              >
                <span data-feather="calendar"></span>
                Esta semana
              </button>
            </div> -->
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Health_pros",
};
</script>
