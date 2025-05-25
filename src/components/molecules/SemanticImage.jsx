const SemanticImage = (src, alt, caption) => {        
  return (
    <figure className="semantic-image">
      <img src={src} alt={alt} />
      <figcaption className="caption">{caption}</figcaption>
    </figure>
  );
}

export default SemanticImage;