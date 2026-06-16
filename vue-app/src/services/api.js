const apiBaseUrl = (import.meta.env.VITE_API_BASE_URL || '/api').replace(/\/$/, '');

async function request(path) {
  const response = await fetch(`${apiBaseUrl}${path}`, {
    headers: {
      Accept: 'application/json',
    },
  });

  if (!response.ok) {
    throw new Error(`Request failed with status ${response.status}`);
  }

  return response.json();
}

export async function fetchStudents() {
  const students = await request('/student');
  return Array.isArray(students) ? students : [];
}

export async function fetchProducts() {
  const response = await request('/products');
  return Array.isArray(response?.data) ? response.data : [];
}
