<script setup>
import { computed, onMounted, ref } from 'vue';
import { fetchProducts, fetchStudents } from './services/api';

const students = ref([]);
const products = ref([]);
const isLoading = ref(true);
const errorMessage = ref('');
const lastUpdated = ref('');

const currency = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
});

const apiBaseLabel = import.meta.env.VITE_API_BASE_URL || '/api';

const stats = computed(() => {
  const activeProducts = products.value.filter((product) => product.is_active);
  const lowStockProducts = products.value.filter((product) => product.stock <= 5);
  const averagePrice = products.value.length
    ? products.value.reduce((sum, product) => sum + Number(product.price || 0), 0) /
      products.value.length
    : 0;

  return [
    {
      label: 'Students',
      value: students.value.length,
      hint: 'Loaded from /api/student',
    },
    {
      label: 'Products',
      value: products.value.length,
      hint: 'Loaded from /api/products',
    },
    {
      label: 'Active',
      value: activeProducts.length,
      hint: 'Products marked active',
    },
    {
      label: 'Low stock',
      value: lowStockProducts.length,
      hint: 'Stock at 5 or below',
    },
    {
      label: 'Avg. price',
      value: currency.format(averagePrice),
      hint: 'Average product price',
    },
  ];
});

async function loadDashboard() {
  isLoading.value = true;
  errorMessage.value = '';

  try {
    const [studentData, productData] = await Promise.all([
      fetchStudents(),
      fetchProducts(),
    ]);

    students.value = studentData;
    products.value = productData;
    lastUpdated.value = new Date().toLocaleString();
  } catch (error) {
    errorMessage.value = error instanceof Error ? error.message : 'Failed to load API data.';
  } finally {
    isLoading.value = false;
  }
}

function formatPrice(price) {
  return currency.format(Number(price || 0));
}

function badgeClass(isActive) {
  return isActive ? 'status status-on' : 'status status-off';
}

onMounted(loadDashboard);
</script>

<template>
  <main class="shell">
    <section class="hero">
      <div class="hero__copy">
        <div class="badge">Laravel API connected</div>
        <h1>Vue dashboard wired to your Laravel backend</h1>
        <p class="lede">
          This Vue app now reads live data from the Laravel API, so you can
          build, test, and deploy the frontend separately while keeping the
          backend in place.
        </p>

        <div class="stack">
          <span>API base: {{ apiBaseLabel }}</span>
          <span>{{ lastUpdated ? `Updated ${lastUpdated}` : 'Waiting for data' }}</span>
        </div>
      </div>

      <button class="refresh" type="button" @click="loadDashboard" :disabled="isLoading">
        {{ isLoading ? 'Loading...' : 'Refresh data' }}
      </button>
    </section>

    <section v-if="errorMessage" class="banner">
      {{ errorMessage }}
    </section>

    <section class="stats">
      <article v-for="stat in stats" :key="stat.label" class="panel stat-card">
        <span class="stat-card__label">{{ stat.label }}</span>
        <strong class="stat-card__value">{{ stat.value }}</strong>
        <small class="stat-card__hint">{{ stat.hint }}</small>
      </article>
    </section>

    <section class="grid">
      <article class="panel">
        <div class="panel__head">
          <div>
            <h2>Students</h2>
            <p>Data from Laravel `StudentController@index`.</p>
          </div>
          <span class="count">{{ students.length }}</span>
        </div>

        <div v-if="isLoading" class="empty-state">Loading students...</div>
        <div v-else-if="!students.length" class="empty-state">No students returned yet.</div>
        <div v-else class="list">
          <article v-for="student in students" :key="student.id" class="list-item">
            <div>
              <h3>{{ student.name }}</h3>
              <p>{{ student.email }}</p>
            </div>
            <div class="meta">
              <span>ID: {{ student.student_id }}</span>
              <span>{{ student.phone }}</span>
            </div>
          </article>
        </div>
      </article>

      <article class="panel">
        <div class="panel__head">
          <div>
            <h2>Products</h2>
            <p>Data from Laravel `ProductController@index`.</p>
          </div>
          <span class="count">{{ products.length }}</span>
        </div>

        <div v-if="isLoading" class="empty-state">Loading products...</div>
        <div v-else-if="!products.length" class="empty-state">No products returned yet.</div>
        <div v-else class="cards">
          <article v-for="product in products" :key="product.id" class="product-card">
            <div class="product-card__image" v-if="product.image_url">
              <img :src="product.image_url" :alt="product.name" />
            </div>

            <div class="product-card__body">
              <div class="product-card__top">
                <h3>{{ product.name }}</h3>
                <span :class="badgeClass(product.is_active)">
                  {{ product.is_active ? 'Active' : 'Inactive' }}
                </span>
              </div>

              <p class="product-card__category">
                {{ product.category?.name || 'No category' }}
              </p>

              <div class="product-card__meta">
                <span>{{ formatPrice(product.price) }}</span>
                <span>Stock: {{ product.stock }}</span>
              </div>
            </div>
          </article>
        </div>
      </article>
    </section>
  </main>
</template>
