/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './style.scss';

/**
 * Internal dependencies
 */
import Edit from './edit';
import save from './save';
import metadata from './block.json';

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType( metadata.name, {
	/**
	 * @see ./edit.js
	 */
	icon: {
		src: (
			<svg
				xmlns="http://www.w3.org/2000/svg"
				width="100%"
				height="100%"
				viewBox="0 0 600 600"
			>
				<path
					d="M207.606 384.462l91.025 91.025a12.29 12.29 0 0 1 0 17.36l-13.614 13.606a12.26 12.26 0 0 1-17.351 0l-91.025-91.025a12.26 12.26 0 0 1 0-17.351l13.606-13.614a12.29 12.29 0 0 1 17.36 0m-30.976-73.975l91.025-91.025c4.797-4.797 12.572-4.797 17.36 0l13.614 13.606a12.29 12.29 0 0 1 0 17.36l-91.033 91.025a12.28 12.28 0 0 1-17.351 0l-13.614-13.606a12.29 12.29 0 0 1 0-17.36"
					fill="#007581"
				/>
				<path
					d="M392.394 215.531l-91.025-91.025a12.26 12.26 0 0 1 0-17.351l13.606-13.614a12.29 12.29 0 0 1 17.36 0l91.025 91.033a12.25 12.25 0 0 1 0 17.343l-13.606 13.614a12.27 12.27 0 0 1-17.36 0m30.966 73.978l-91.025 91.025a12.29 12.29 0 0 1-17.36 0l-13.606-13.606a12.29 12.29 0 0 1 0-17.36l91.025-91.025a12.27 12.27 0 0 1 17.36 0l13.606 13.606a12.27 12.27 0 0 1 0 17.36"
					fill="#00a990"
				/>
				<path
					d="M497.334 258.54l91.025 91.025a12.27 12.27 0 0 1 0 17.36l-13.606 13.606a12.26 12.26 0 0 1-17.351 0l-91.033-91.025a12.28 12.28 0 0 1 0-17.351l13.614-13.614a12.28 12.28 0 0 1 17.351 0m-30.966-73.974l91.025-91.025a12.29 12.29 0 0 1 17.36 0l13.614 13.606a12.29 12.29 0 0 1 0 17.36l-91.033 91.025a12.28 12.28 0 0 1-17.351 0l-13.614-13.606a12.29 12.29 0 0 1 0-17.36"
					fill="#00adbc"
				/>
				<path
					d="M102.658 340.266l-91.025-91.025a12.28 12.28 0 0 1 0-17.351l13.606-13.614a12.29 12.29 0 0 1 17.36 0l91.025 91.033a12.25 12.25 0 0 1 0 17.343l-13.606 13.614a12.27 12.27 0 0 1-17.36 0m30.966 73.979L42.599 505.27a12.28 12.28 0 0 1-17.351 0l-13.614-13.606a12.29 12.29 0 0 1 0-17.36l91.033-91.025a12.26 12.26 0 0 1 17.351 0l13.606 13.606a12.27 12.27 0 0 1 0 17.36"
					fill="#024f51"
				/>
			</svg>
		),
	},
	edit: Edit,

	/**
	 * @see ./save.js
	 */
	save,
} );
