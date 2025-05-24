const Title = ({ children, className = '', ...props }) => {
  return (
    <h2 className={`event-block-title ${className}`} {...props}>
      {children}
    </h2>
  );
}

export default Title;