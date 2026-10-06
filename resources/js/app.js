document.addEventListener('DOMContentLoaded', () => {
	const orderForm = document.querySelector('[data-order-form]');
	const toastRegion = document.querySelector('#toast-region');

	if (!orderForm || !toastRegion) return;

	const rules = {
		customer_name: { label: 'Customer name', validate: (value) => value.length >= 2 ? '' : 'Please enter your full name.' },
		customer_email: { label: 'Email address', validate: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) ? '' : 'Please enter a valid email address.' },
		product_name: { label: 'Product name', validate: (value) => value.length >= 2 ? '' : 'Tell us what you would like to order.' },
		quantity: { label: 'Quantity', validate: (value) => Number.isInteger(Number(value)) && Number(value) >= 1 && Number(value) <= 1000 ? '' : 'Quantity must be between 1 and 1,000.' },
		unit_price: { label: 'Unit price', validate: (value) => Number(value) >= 0.01 ? '' : 'Unit price must be at least $0.01.' }
	};

	const showToast = (fieldName, message) => {
		const toast = document.createElement('div');
		toast.className = 'toast';
		toast.innerHTML = `<strong>${rules[fieldName].label}</strong><span>${message}</span>`;
		toastRegion.append(toast);
		window.setTimeout(() => { toast.classList.add('is-leaving'); window.setTimeout(() => toast.remove(), 300); }, 4200);
	};

	document.querySelectorAll('[data-server-errors] span').forEach((error) => {
		const fieldName = Object.keys(rules).find((name) => error.textContent.toLowerCase().includes(rules[name].label.toLowerCase()));

		if (fieldName) {
			showToast(fieldName, error.textContent);
		}
	});

	orderForm.addEventListener('submit', (event) => {
		let firstInvalidField = null;
		Object.entries(rules).forEach(([fieldName, rule]) => {
			const field = orderForm.elements[fieldName];
			const message = rule.validate(field.value.trim());
			field.closest('.field').classList.toggle('field-invalid', Boolean(message));
			if (message) { firstInvalidField ??= field; showToast(fieldName, message); }
		});
		if (firstInvalidField) { event.preventDefault(); firstInvalidField.focus(); }
	});

	Object.keys(rules).forEach((fieldName) => {
		orderForm.elements[fieldName].addEventListener('input', (event) => {
			const field = event.currentTarget;
			field.closest('.field').classList.toggle('field-invalid', Boolean(rules[fieldName].validate(field.value.trim())));
		});
	});
});
