import index from "./pages/index.vue";
import id from "./pages/checkout/id.vue";

export default [
  {
    path: "/",
    name: "home",
    component: index,
  },
  {
    path: "/restaurant/:id",
    name: "single-restaurant",
    component: id,
  },
];
