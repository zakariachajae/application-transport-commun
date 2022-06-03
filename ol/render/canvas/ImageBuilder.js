var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
/**
 * @module ol/render/canvas/ImageBuilder
 */
import CanvasBuilder from './Builder.js';
import CanvasInstruction from './Instruction.js';
var CanvasImageBuilder = /** @class */ (function (_super) {
    __extends(CanvasImageBuilder, _super);
    /**
     * @param {number} tolerance Tolerance.
     * @param {import("../../extent.js").Extent} maxExtent Maximum extent.
     * @param {number} resolution Resolution.
     * @param {number} pixelRatio Pixel ratio.
     */
    function CanvasImageBuilder(tolerance, maxExtent, resolution, pixelRatio) {
        var _this = _super.call(this, tolerance, maxExtent, resolution, pixelRatio) || this;
        /**
         * @private
         * @type {HTMLCanvasElement|HTMLVideoElement|HTMLImageElement}
         */
        _this.hitDetectionImage_ = null;
        /**
         * @private
         * @type {HTMLCanvasElement|HTMLVideoElement|HTMLImageElement}
         */
        _this.image_ = null;
        /**
         * @private
         * @type {number|undefined}
         */
        _this.imagePixelRatio_ = undefined;
        /**
         * @private
         * @type {number|undefined}
         */
        _this.anchorX_ = undefined;
        /**
         * @private
         * @type {number|undefined}
         */
        _this.anchorY_ = undefined;
        /**
         * @private
         * @type {number|undefined}
         */
        _this.height_ = undefined;
        /**
         * @private
         * @type {number|undefined}
         */
        _this.opacity_ = undefined;
        /**
         * @private
         * @type {number|undefined}
         */
        _this.originX_ = undefined;
        /**
         * @private
         * @type {number|undefined}
         */
        _this.originY_ = undefined;
        /**
         * @private
         * @type {boolean|undefined}
         */
        _this.rotateWithView_ = undefined;
        /**
         * @private
         * @type {number|undefined}
         */
        _this.rotation_ = undefined;
        /**
         * @private
         * @type {import("../../size.js").Size|undefined}
         */
        _this.scale_ = undefined;
        /**
         * @private
         * @type {number|undefined}
         */
        _this.width_ = undefined;
        /**
         * Data shared with a text builder for combined decluttering.
         * @private
         * @type {import("../canvas.js").DeclutterImageWithText}
         */
        _this.declutterImageWithText_ = undefined;
        return _this;
    }
    /**
     * @param {import("../../geom/Point.js").default|import("../Feature.js").default} pointGeometry Point geometry.
     * @param {import("../../Feature.js").FeatureLike} feature Feature.
     */
    CanvasImageBuilder.prototype.drawPoint = function (pointGeometry, feature) {
        if (!this.image_) {
            return;
        }
        this.beginGeometry(pointGeometry, feature);
        var flatCoordinates = pointGeometry.getFlatCoordinates();
        var stride = pointGeometry.getStride();
        var myBegin = this.coordinates.length;
        var myEnd = this.appendFlatPointCoordinates(flatCoordinates, stride);
        this.instructions.push([
            CanvasInstruction.DRAW_IMAGE,
            myBegin,
            myEnd,
            this.image_,
            // Remaining arguments to DRAW_IMAGE are in alphabetical order
            this.anchorX_ * this.imagePixelRatio_,
            this.anchorY_ * this.imagePixelRatio_,
            Math.ceil(this.height_ * this.imagePixelRatio_),
            this.opacity_,
            this.originX_,
            this.originY_,
            this.rotateWithView_,
            this.rotation_,
            [
                (this.scale_[0] * this.pixelRatio) / this.imagePixelRatio_,
                (this.scale_[1] * this.pixelRatio) / this.imagePixelRatio_,
            ],
            Math.ceil(this.width_ * this.imagePixelRatio_),
            this.declutterImageWithText_,
        ]);
        this.hitDetectionInstructions.push([
            CanvasInstruction.DRAW_IMAGE,
            myBegin,
            myEnd,
            this.hitDetectionImage_,
            // Remaining arguments to DRAW_IMAGE are in alphabetical order
            this.anchorX_,
            this.anchorY_,
            this.height_,
            this.opacity_,
            this.originX_,
            this.originY_,
            this.rotateWithView_,
            this.rotation_,
            this.scale_,
            this.width_,
            this.declutterImageWithText_,
        ]);
        this.endGeometry(feature);
    };
    /**
     * @param {import("../../geom/MultiPoint.js").default|import("../Feature.js").default} multiPointGeometry MultiPoint geometry.
     * @param {import("../../Feature.js").FeatureLike} feature Feature.
     */
    CanvasImageBuilder.prototype.drawMultiPoint = function (multiPointGeometry, feature) {
        if (!this.image_) {
            return;
        }
        this.beginGeometry(multiPointGeometry, feature);
        var flatCoordinates = multiPointGeometry.getFlatCoordinates();
        var stride = multiPointGeometry.getStride();
        var myBegin = this.coordinates.length;
        var myEnd = this.appendFlatPointCoordinates(flatCoordinates, stride);
        this.instructions.push([
            CanvasInstruction.DRAW_IMAGE,
            myBegin,
            myEnd,
            this.image_,
            // Remaining arguments to DRAW_IMAGE are in alphabetical order
            this.anchorX_ * this.imagePixelRatio_,
            this.anchorY_ * this.imagePixelRatio_,
            Math.ceil(this.height_ * this.imagePixelRatio_),
            this.opacity_,
            this.originX_,
            this.originY_,
            this.rotateWithView_,
            this.rotation_,
            [
                (this.scale_[0] * this.pixelRatio) / this.imagePixelRatio_,
                (this.scale_[1] * this.pixelRatio) / this.imagePixelRatio_,
            ],
            Math.ceil(this.width_ * this.imagePixelRatio_),
            this.declutterImageWithText_,
        ]);
        this.hitDetectionInstructions.push([
            CanvasInstruction.DRAW_IMAGE,
            myBegin,
            myEnd,
            this.hitDetectionImage_,
            // Remaining arguments to DRAW_IMAGE are in alphabetical order
            this.anchorX_,
            this.anchorY_,
            this.height_,
            this.opacity_,
            this.originX_,
            this.originY_,
            this.rotateWithView_,
            this.rotation_,
            this.scale_,
            this.width_,
            this.declutterImageWithText_,
        ]);
        this.endGeometry(feature);
    };
    /**
     * @return {import("../canvas.js").SerializableInstructions} the serializable instructions.
     */
    CanvasImageBuilder.prototype.finish = function () {
        this.reverseHitDetectionInstructions();
        // FIXME this doesn't really protect us against further calls to draw*Geometry
        this.anchorX_ = undefined;
        this.anchorY_ = undefined;
        this.hitDetectionImage_ = null;
        this.image_ = null;
        this.imagePixelRatio_ = undefined;
        this.height_ = undefined;
        this.scale_ = undefined;
        this.opacity_ = undefined;
        this.originX_ = undefined;
        this.originY_ = undefined;
        this.rotateWithView_ = undefined;
        this.rotation_ = undefined;
        this.width_ = undefined;
        return _super.prototype.finish.call(this);
    };
    /**
     * @param {import("../../style/Image.js").default} imageStyle Image style.
     * @param {Object=} opt_sharedData Shared data.
     */
    CanvasImageBuilder.prototype.setImageStyle = function (imageStyle, opt_sharedData) {
        var anchor = imageStyle.getAnchor();
        var size = imageStyle.getSize();
        var hitDetectionImage = imageStyle.getHitDetectionImage();
        var image = imageStyle.getImage(this.pixelRatio);
        var origin = imageStyle.getOrigin();
        this.imagePixelRatio_ = imageStyle.getPixelRatio(this.pixelRatio);
        this.anchorX_ = anchor[0];
        this.anchorY_ = anchor[1];
        this.hitDetectionImage_ = hitDetectionImage;
        this.image_ = image;
        this.height_ = size[1];
        this.opacity_ = imageStyle.getOpacity();
        this.originX_ = origin[0];
        this.originY_ = origin[1];
        this.rotateWithView_ = imageStyle.getRotateWithView();
        this.rotation_ = imageStyle.getRotation();
        this.scale_ = imageStyle.getScaleArray();
        this.width_ = size[0];
        this.declutterImageWithText_ = opt_sharedData;
    };
    return CanvasImageBuilder;
}(CanvasBuilder));
export default CanvasImageBuilder;
//# sourceMappingURL=ImageBuilder.js.map