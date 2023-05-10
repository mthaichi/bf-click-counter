import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	BlockAlignmentToolbar,
	BlockControls,
	ColorPalette,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	RangeControl,
	ToggleControl,
	BaseControl,
	__experimentalBoxControl as BoxControl, // eslint-disable-line @wordpress/no-unsafe-wp-apis
} from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
export default function Edit( props ) {
	const blockProps = useBlockProps();
	const { attributes, setAttributes } = props;
	const {
		counterKey,
		counterLabel,
		paddingValues,
		borderRadius,
		buttonAlign,
		borderWidth,
		borderColor,
		ipCountPrevention
	} = props.attributes;

	const units = [
		{
			value: 'px',
			label: 'px',
			default: 0,
		},
		{
			value: '%',
			label: '%',
			default: 0,
		},
		{
			value: 'vw',
			label: 'vw',
			default: 0,
		},
		{
			value: 'vh',
			label: 'vh',
			default: 0,
		},
	];

	const resetPaddingValues = {
		top: '0px',
		left: '0px',
		right: '0px',
		bottom: '0px',
	};

	return (
		<>
			<BlockControls>
				<BlockAlignmentToolbar
					value={ buttonAlign }
					onChange={ ( value ) =>
						setAttributes( { buttonAlign: value } )
					}
				/>
			</BlockControls>
			<InspectorControls key="setting">
				<PanelBody
					title={ __( 'Counter setting', 'bf-click-counter' ) }
				>
					<TextControl
						label={ __( 'Counter Key', 'bf-click-counter' ) }
						value={ counterKey }
						className={ `mt-0 mb-3` }
						onChange={ ( value ) =>
							setAttributes( { counterKey: value } )
						}
						placeholder={ 'Counter Key' }
					/>
					<TextControl
						label={ __( 'Label', 'bf-click-counter' ) }
						value={ counterLabel }
						className={ `mt-0 mb-3` }
						onChange={ ( value ) =>
							setAttributes( { counterLabel: value } )
						}
						placeholder={ 'Counter Key' }
					/>
					<ToggleControl
						label={__('IP-based consecutive click count prevention', 'bf-click-counter')}
						checked={ipCountPrevention}
						onChange={(checked) => setAttributes({ ipCountPrevention: checked })}
					/>
				</PanelBody>
			</InspectorControls>
			<InspectorControls group="styles">
				<PanelBody title={ __( 'Padding', 'bf-click-counter' ) }>
					<BoxControl
						label="Padding"
						values={ paddingValues }
						onChange={ ( value ) =>
							setAttributes( { paddingValues: value } )
						} // 保存処理
						units={ units }
						allowReset={ true }
						resetValues={ resetPaddingValues }
					/>
				</PanelBody>
				<PanelBody title={ __( 'Border setting', 'bf-click-counter' ) }>
					<BaseControl
						label={ __( 'Border Width', 'vk-blocks' ) }
						id={ `bf-click-counter-borderWidth` }
					>
						<RangeControl
							value={ borderWidth }
							onChange={ ( value ) =>
								setAttributes( {
									borderWidth: Number( value ),
								} )
							}
							min={ 0 }
							max={ 50 }
						/>
					</BaseControl>
					<BaseControl
						label={ __( 'Border radius', 'vk-blocks' ) }
						id={ `bf-click-counter-borderRadius` }
					>
						<RangeControl
							value={ borderRadius }
							onChange={ ( value ) =>
								setAttributes( {
									borderRadius: Number( value ),
								} )
							}
							min={ 0 }
							max={ 100 }
						/>
					</BaseControl>
					<BaseControl
						label={ __( 'Border Color', 'vk-blocks' ) }
						id={ `bf-click-counter-borderColor` }
					>
						<ColorPalette
							value={ borderColor }
							onChange={ ( value ) =>
								setAttributes( {
									borderColor: value,
								} )
							}
						/>
					</BaseControl>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="bf-click-counter/click-counter"
					attributes={ attributes }
					classnames={ blockProps.className }
				/>
			</div>
		</>
	);
}
