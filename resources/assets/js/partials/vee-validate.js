import { extend } from 'vee-validate';
import { required, email, image } from 'vee-validate/dist/rules';
// import * as rules from 'vee-validate/dist/rules';
let locale_bn = check_locale('bn');
extend('email', email);
extend('positive', {
	validate(value) {
		return value >= 0;
	},
	message: (fieldName) => {
		let field = _.upperFirst(_.replace(`${fieldName}`));

		if(check_locale('bn')) return `${field} ফিল্ড অবশ্যই `+n2l('0')+` বা তার বেশি হতে হবে`;
		else return `The ${field} field must be greated than 0`;
	}
});
extend('negative', value => {
	return value < 0;
});
extend('min', {
	validate(value, args) {
		return value.length >= args.length;
	},
	params: ['length'],
	message: (fieldName, placeholders) => {
		let field = _.upperFirst(_.replace(fieldName));
		let length = n2l(placeholders.length);
		
		if(check_locale('bn')) return `${field} ফিল্ডে অবশ্যই কমপক্ষে ${length} অক্ষর হতে হবে`;
		else return `The ${field} field must have at least ${length}`;
	}
});
extend('max', {
	validate(value, args) {
		return value.length <= args.length;
	},
	params: ['length']
});
extend('minmax', {
	validate(value, { min, max }) {
		return value.length >= min && value.length <= max;
	},
	params: ['min', 'max']
});
extend('image', {
	...image,
	message: (fieldName) => {
		let field = _.startCase(_.replace(`${fieldName}`, /[_-]/g, ' '));
		return check_locale('bn') ? `ফিল্ডটি দরকার`:`This field is required`;
	}
});

extend('required', {
	...required,
	message: (fieldName) => {
		let field = _.startCase(_.replace(`${fieldName}`, /[_-]/g, ' '));
		return check_locale('bn') ? `${field} ফিল্ডটি দরকার`:`${field} field is required`;
	}
});